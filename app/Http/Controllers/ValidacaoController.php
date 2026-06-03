<?php

namespace App\Http\Controllers;

use App\Models\Correcao;
use App\Models\Entrega;
use App\Models\ProgressoGrupo;
use App\Models\User;
use App\Models\Validacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class ValidacaoController extends AdminResourceController
{
    protected string $modelClass = Validacao::class;
    protected string $routeName = 'validacoes';
    protected string $title = 'Validação';
    protected string $table = 'validacoes';
    protected string $primaryKey = 'id_validacao';

    public function index()
    {
        $entregas = Entrega::with(['grupo.turma', 'grupo.usuarios', 'etapa', 'ultimaValidacao.professor', 'correcoes.professor'])
            ->latest('id_entrega')
            ->paginate(10);

        return view('validacoes.index', compact('entregas'));
    }

    protected function fields(): array
    {
        return [
            'id_entrega' => ['label' => 'Entrega', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->entregas()],
            'id_professor' => ['label' => 'Professor', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->users()],
            'status_validacao' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['pendente', 'aprovado', 'reprovado'])], 'options' => [
                'pendente' => 'Pendente',
                'aprovado' => 'Aprovado',
                'reprovado' => 'Reprovado',
            ]],
            'comentario' => ['label' => 'Comentário', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
        ];
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $validacao = Validacao::create($data);
        $this->syncDeliveryProgress($validacao);
        $this->createCorrectionHistory($validacao);

        return redirect()->route('validacoes.index')->with('success', 'Validação cadastrada com sucesso.');
    }

    public function update(Request $request, string $id)
    {
        $record = Validacao::findOrFail($id);
        $data = $request->validate($this->rules($record));

        $record->update($data);
        $this->syncDeliveryProgress($record);
        $this->createCorrectionHistory($record);

        return redirect()->route('validacoes.index')->with('success', 'Validação atualizada com sucesso.');
    }

    private function syncDeliveryProgress(Validacao $validacao): void
    {
        $entrega = $validacao->entrega;

        if (! $entrega) {
            return;
        }

        $percentual = match ($validacao->status_validacao) {
            'aprovado' => 100,
            'reprovado' => 50,
            default => 80,
        };

        ProgressoGrupo::updateOrCreate(
            [
                'id_grupo' => $entrega->id_grupo,
                'id_etapa' => $entrega->id_etapa,
            ],
            [
                'status_progresso' => $validacao->status_validacao,
                'percentual' => $percentual,
                'observacao' => $validacao->comentario,
            ]
        );

        $entrega->update([
            'status_Entrega' => match ($validacao->status_validacao) {
                'aprovado' => 'aprovado',
                'reprovado' => 'reprovado',
                default => 'em_analise',
            },
        ]);
    }

    private function createCorrectionHistory(Validacao $validacao): void
    {
        Correcao::create([
            'id_entrega' => $validacao->id_entrega,
            'id_professor' => $validacao->id_professor,
            'status_correcao' => $validacao->status_validacao,
            'comentario' => $validacao->comentario ?: 'Validação registrada sem comentário.',
        ]);
    }

    private function entregas(): array
    {
        if (! Schema::hasTable('entrega')) {
            return [];
        }

        return Entrega::orderByDesc('id_entrega')->pluck('nome_arquivo', 'id_entrega')->toArray();
    }

    private function users(): array
    {
        if (! Schema::hasTable('users')) {
            return [];
        }

        return User::whereIn('tipo', ['professor', 'coordenador'])->orderBy('name')->pluck('name', 'id')->toArray();
    }
}
