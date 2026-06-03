<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Turma;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class GrupoController extends AdminResourceController
{
    protected string $modelClass = Grupo::class;
    protected string $routeName = 'grupos';
    protected string $title = 'Grupo';
    protected string $table = 'grupos';
    protected string $primaryKey = 'id_grupo';

    public function index()
    {
        $records = collect();
        $tableExists = Schema::hasTable($this->table);

        if ($tableExists) {
            $user = auth()->user();
            $isStaff = in_array(strtolower(trim((string) $user?->tipo)), ['professor', 'coordenador'], true);

            $records = Grupo::when(! $isStaff, function ($query) use ($user) {
                $query->whereHas('usuarios', fn ($usuarios) => $usuarios->where('users.id', $user->id));
            })
                ->with(['turma', 'usuarios', 'resultadoSorteio.tema', 'progressos.etapa', 'entregas.etapa', 'entregas.ultimaValidacao', 'notas.professor'])
                ->latest('id_grupo')
                ->paginate(10);
        }

        return view('grupos.index', $this->viewData(compact('records', 'tableExists', 'isStaff')));
    }

    public function show(string $id)
    {
        $user = auth()->user();
        $isStaff = in_array(strtolower(trim((string) $user?->tipo)), ['professor', 'coordenador'], true);

        $grupo = Grupo::with(['turma.etapas', 'usuarios', 'resultadoSorteio.tema', 'progressos.etapa', 'entregas.etapa', 'entregas.ultimaValidacao', 'notas.professor'])
            ->when(! $isStaff, function ($query) use ($user) {
                $query->whereHas('usuarios', fn ($usuarios) => $usuarios->where('users.id', $user->id));
            })
            ->where('id_grupo', $id)
            ->firstOrFail();

        return view('grupos.show', compact('grupo', 'isStaff'));
    }

    protected function fields(): array
    {
        return [
            'nome_grupo' => ['label' => 'Nome do grupo', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'id_turma' => ['label' => 'Turma', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->turmas()],
            'status_grupo' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['ativo', 'inativo'])], 'options' => [
                'ativo' => 'Ativo',
                'inativo' => 'Inativo',
            ]],
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
