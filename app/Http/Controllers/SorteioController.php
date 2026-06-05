<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\ProgressoGrupo;
use App\Models\ResultadoSorteio;
use App\Models\Sorteio;
use App\Models\Tema;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function index()
    {
        $records = collect();
        $tableExists = Schema::hasTable($this->table);

        if ($tableExists) {
            $records = Sorteio::with(['turma', 'resultados'])
                ->latest('id_sorteio')
                ->paginate(10);
        }

        return view('coordenador_professor.sorteios.index', $this->viewData(compact('records', 'tableExists')));
    }

    public function show(string $id)
    {
        $record = Sorteio::with(['turma', 'executor', 'resultados.grupo', 'resultados.tema'])->findOrFail($id);

        return view('coordenador_professor.sorteios.show', [
            'record' => $record,
            'title' => $this->title,
            'routeName' => $this->routeName,
        ]);
    }

    public function executar(Request $request, string $id)
    {
        $sorteio = Sorteio::with('turma')->findOrFail($id);
        $grupos = Grupo::where('id_turma', $sorteio->id_turma)
            ->where('status_grupo', 'ativo')
            ->with(['preferenciasTema' => fn ($query) => $query->orderBy('prioridade')])
            ->withCount('usuarios')
            ->inRandomOrder()
            ->get();
        $etapas = $sorteio->turma?->etapas()->orderBy('ordem_etapa')->get() ?? collect();

        if ($grupos->isEmpty()) {
            return back()->with('success', 'Cadastre grupos nesta turma antes de executar o sorteio.');
        }

        if ($grupos->contains(fn ($grupo) => $grupo->usuarios_count === 0)) {
            return back()->with('success', 'Todos os grupos precisam ter pelo menos um aluno antes do sorteio.');
        }

        if ($etapas->isEmpty()) {
            return back()->with('success', 'Cadastre as etapas do cronograma antes de executar o sorteio.');
        }

        $temasAnteriores = ResultadoSorteio::where('id_sorteio', $sorteio->id_sorteio)->pluck('id_tema');
        $temas = Tema::where('id_turma', $sorteio->id_turma)
            ->where(function ($query) use ($temasAnteriores) {
                $query->where('status_tema', 'disponivel')
                    ->orWhereIn('id_tema', $temasAnteriores);
            })
            ->inRandomOrder()
            ->get();

        if ($temas->count() < $grupos->count()) {
            return back()->with('success', 'Nao ha temas disponiveis suficientes para todos os grupos.');
        }

        DB::transaction(function () use ($sorteio, $grupos, $temas, $etapas, $request, $temasAnteriores) {
            Tema::whereIn('id_tema', $temasAnteriores)->update(['status_tema' => 'disponivel']);
            ResultadoSorteio::where('id_sorteio', $sorteio->id_sorteio)->delete();

            $temasDisponiveis = $temas->keyBy('id_tema');
            $atribuicoes = [];

            for ($prioridade = 1; $prioridade <= 3; $prioridade++) {
                foreach ($grupos as $grupo) {
                    if (isset($atribuicoes[$grupo->id_grupo])) {
                        continue;
                    }

                    $preferencia = $grupo->preferenciasTema->firstWhere('prioridade', $prioridade);

                    if ($preferencia && $temasDisponiveis->has($preferencia->id_tema)) {
                        $atribuicoes[$grupo->id_grupo] = [
                            'grupo' => $grupo,
                            'tema' => $temasDisponiveis->pull($preferencia->id_tema),
                            'criterio' => 'preferencia',
                            'prioridade' => $prioridade,
                        ];
                    }
                }
            }

            foreach ($grupos as $grupo) {
                if (isset($atribuicoes[$grupo->id_grupo])) {
                    continue;
                }

                $atribuicoes[$grupo->id_grupo] = [
                    'grupo' => $grupo,
                    'tema' => $temasDisponiveis->shift(),
                    'criterio' => 'aleatorio',
                    'prioridade' => null,
                ];
            }

            foreach ($atribuicoes as $atribuicao) {
                ResultadoSorteio::create([
                    'id_sorteio' => $sorteio->id_sorteio,
                    'id_grupo' => $atribuicao['grupo']->id_grupo,
                    'id_tema' => $atribuicao['tema']->id_tema,
                    'criterio' => $atribuicao['criterio'],
                    'prioridade_atendida' => $atribuicao['prioridade'],
                ]);

                $atribuicao['tema']->update(['status_tema' => 'reservado']);

                foreach ($etapas as $etapa) {
                    ProgressoGrupo::updateOrCreate(
                        [
                            'id_grupo' => $atribuicao['grupo']->id_grupo,
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

            $preferenciasAtendidas = collect($atribuicoes)->where('criterio', 'preferencia')->count();
            $aleatorios = collect($atribuicoes)->where('criterio', 'aleatorio')->count();

            $sorteio->update([
                'status_sorteio' => 'realizado',
                'data_sorteio' => now()->toDateString(),
                'executado_por' => $request->user()?->id,
                'executado_em' => now(),
                'resumo_sorteio' => "{$grupos->count()} grupos, {$temas->count()} temas disponiveis, {$preferenciasAtendidas} preferencias atendidas e {$aleatorios} temas aleatorios.",
            ]);
        });

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
