<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\ProgressoGrupo;
use App\Models\ResultadoSorteio;
use App\Models\Sorteio;
use App\Models\Tema;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class SorteioController extends AdminResourceController
{
    protected string $modelClass = Sorteio::class;
    protected string $routeName = 'sorteios';
    protected string $title = 'Sorteio';
    protected string $table = 'sorteios';
    protected string $primaryKey = 'id_sorteio';

    protected function fields(): array
    {
        return [
            'id_turma' => ['label' => 'Turma', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->turmas()],
            'data_sorteio' => ['label' => 'Data do sorteio', 'type' => 'date', 'rules' => ['required', 'date']],
            'status_sorteio' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['agendado', 'realizado', 'cancelado'])], 'options' => [
                'agendado' => 'Agendado',
                'realizado' => 'Realizado',
                'cancelado' => 'Cancelado',
            ]],
        ];
    }

    public function show(string $id)
    {
        $record = Sorteio::with(['turma', 'resultados.grupo', 'resultados.tema'])->findOrFail($id);

        return view('coordenador_professor.sorteios.show', [
            'record' => $record,
            'title' => $this->title,
            'routeName' => $this->routeName,
        ]);
    }

    public function executar(Request $request, string $id)
    {
        $sorteio = Sorteio::findOrFail($id);
        $grupos = Grupo::where('id_turma', $sorteio->id_turma)
            ->withCount('usuarios')
            ->orderBy('nome_grupo')
            ->get();
        $etapas = $sorteio->turma?->etapas()->orderBy('ordem_etapa')->get() ?? collect();
        $temas = Tema::where('id_turma', $sorteio->id_turma)
            ->where('status_tema', 'disponivel')
            ->inRandomOrder()
            ->get();

        if ($grupos->isEmpty()) {
            return back()->with('success', 'Cadastre grupos nesta turma antes de executar o sorteio.');
        }

        if ($grupos->contains(fn ($grupo) => $grupo->usuarios_count === 0)) {
            return back()->with('success', 'Todos os grupos precisam ter pelo menos um aluno antes do sorteio.');
        }

        if ($etapas->isEmpty()) {
            return back()->with('success', 'Cadastre as etapas do cronograma antes de executar o sorteio.');
        }

        if ($temas->count() < $grupos->count()) {
            return back()->with('success', 'Não há temas disponíveis suficientes para todos os grupos.');
        }

        $temasAnteriores = ResultadoSorteio::where('id_sorteio', $sorteio->id_sorteio)->pluck('id_tema');
        Tema::whereIn('id_tema', $temasAnteriores)->update(['status_tema' => 'disponivel']);
        ResultadoSorteio::where('id_sorteio', $sorteio->id_sorteio)->delete();

        foreach ($grupos as $index => $grupo) {
            $tema = $temas[$index];

            ResultadoSorteio::create([
                'id_sorteio' => $sorteio->id_sorteio,
                'id_grupo' => $grupo->id_grupo,
                'id_tema' => $tema->id_tema,
            ]);

            $tema->update(['status_tema' => 'reservado']);

            foreach ($etapas as $etapa) {
                ProgressoGrupo::updateOrCreate(
                    [
                        'id_grupo' => $grupo->id_grupo,
                        'id_etapa' => $etapa->id_etapa,
                    ],
                    [
                        'status_progresso' => 'pendente',
                        'percentual' => 0,
                        'observacao' => 'Etapa liberada apos sorteio do tema.',
                    ]
                );
            }
        }

        $sorteio->update([
            'status_sorteio' => 'realizado',
            'data_sorteio' => now()->toDateString(),
        ]);

        return redirect()->route('sorteios.show', $sorteio)->with('success', 'Sorteio realizado e resultados publicados.');
    }

    private function turmas(): array
    {
        if (! Schema::hasTable('turmas')) {
            return [];
        }

        return Turma::orderBy('nome_turma')->pluck('nome_turma', 'id_turma')->toArray();
    }
}
