<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Turma;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class TemaController extends AdminResourceController
{
    protected string $modelClass = Tema::class;
    protected string $routeName = 'temas';
    protected string $title = 'Tema';
    protected string $table = 'temas';
    protected string $primaryKey = 'id_tema';

    public function create()
    {
        return view('temas.create', [
            'turmas' => Turma::orderBy('nome_turma')->get(),
        ]);
    }

    public function index()
    {
        $user = auth()->user();
        $isStaff = in_array(strtolower(trim((string) $user?->tipo)), ['professor', 'coordenador'], true);

        $temas = Tema::with('turma')
            ->when(! $isStaff, function ($query) use ($user) {
                $query->whereHas('turma.grupos.usuarios', fn ($usuarios) => $usuarios->where('users.id', $user->id))
                    ->whereIn('status_tema', ['disponivel', 'reservado', 'aprovado']);
            })
            ->orderBy('id_turma')
            ->orderBy('titulo')
            ->paginate(12);

        return view('temas.index', compact('temas', 'isStaff'));
    }

    public function show(string $id)
    {
        $user = auth()->user();
        $isStaff = in_array(strtolower(trim((string) $user?->tipo)), ['professor', 'coordenador'], true);

        $tema = Tema::with('turma')
            ->when(! $isStaff, function ($query) use ($user) {
                $query->whereHas('turma.grupos.usuarios', fn ($usuarios) => $usuarios->where('users.id', $user->id));
            })
            ->where('id_tema', $id)
            ->firstOrFail();

        return view('temas.show', compact('tema', 'isStaff'));
    }

    protected function fields(): array
    {
        return [
            'titulo' => ['label' => 'Título', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'descricao' => ['label' => 'Descrição', 'type' => 'textarea', 'rules' => ['required', 'string']],
            'area' => ['label' => 'Área', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'data_conclusao' => ['label' => 'Data de conclusão', 'type' => 'date', 'rules' => ['nullable', 'date']],
            'status_tema' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['disponivel', 'reservado', 'aprovado'])], 'options' => [
                'disponivel' => 'Disponível',
                'reservado' => 'Reservado',
                'aprovado' => 'Aprovado',
            ]],
            'id_turma' => ['label' => 'Turma', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->turmas()],
        ];
    }

    private function turmas(): array
    {
        if (! Schema::hasTable('turmas')) {
            return [];
        }

        return Turma::orderBy('nome_turma')->pluck('nome_turma', 'id_turma')->toArray();
    }
}
