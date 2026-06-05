<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\PreferenciaTema;
use App\Models\Tema;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class GrupoController extends AdminResourceController
{
    protected string $modelClass = Grupo::class;
    protected string $routeName = 'grupos';
    protected string $title = 'Grupo';
    protected string $table = 'grupos';
    protected string $primaryKey = 'id_grupo';
    private const LIMITE_INTEGRANTES_GRUPO = 3;

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
        $isStaff = $this->isStaff($user);

        $grupo = Grupo::with(['turma.etapas', 'usuarios', 'resultadoSorteio.tema', 'preferenciasTema.tema', 'progressos.etapa', 'entregas.etapa', 'entregas.ultimaValidacao', 'notas.professor'])
            ->when(! $isStaff, function ($query) use ($user) {
                $query->whereHas('usuarios', fn ($usuarios) => $usuarios->where('users.id', $user->id));
            })
            ->where('id_grupo', $id)
            ->firstOrFail();

        $temasDisponiveis = Tema::where('id_turma', $grupo->id_turma)
            ->where('status_tema', 'disponivel')
            ->orderBy('titulo')
            ->get();
        $canUpdatePreferences = $isStaff || $grupo->usuarios->contains('id', $user?->id);

        return view('grupos.show', compact('grupo', 'isStaff', 'temasDisponiveis', 'canUpdatePreferences'));
    }

    public function create()
    {
        return view('grupos.create', [
            'turmas' => Turma::orderBy('nome_turma')->get(),
            'alunos' => User::where('tipo', 'aluno')->orderBy('name')->get(),
            'turmaSelecionada' => request('turma'),
            'isStaff' => true,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome_grupo' => ['required', 'string', 'max:255'],
            'id_turma' => ['required', 'integer', 'exists:turmas,id_turma'],
            'status_grupo' => ['required', Rule::in(['ativo', 'inativo'])],
            'integrantes' => ['nullable', 'array', 'max:'.self::LIMITE_INTEGRANTES_GRUPO],
            'integrantes.*' => ['integer', 'exists:users,id'],
        ]);

        $integrantes = $data['integrantes'] ?? [];
        unset($data['integrantes']);

        $grupo = Grupo::create($data);

        if (! empty($integrantes)) {
            $grupo->usuarios()->sync($integrantes);
        }

        return redirect()->route('grupos.show', $grupo)->with('success', 'Grupo criado com sucesso.');
    }

    public function createAluno(Turma $turma)
    {
        abort_unless($turma->status_turma === 'ativa', 403);

        return view('grupos.create-aluno', compact('turma'));
    }

    public function storeAluno(Request $request, Turma $turma)
    {
        abort_unless($turma->status_turma === 'ativa', 403);

        $jaEntrou = Grupo::where('id_turma', $turma->id_turma)
            ->whereHas('usuarios', fn ($query) => $query->where('users.id', $request->user()->id))
            ->exists();

        if ($jaEntrou) {
            return redirect()->route('aluno.turmas.index')->with('success', 'Você já participa de um grupo nesta turma.');
        }

        $data = $request->validate([
            'nome_grupo' => ['required', 'string', 'max:255'],
        ]);

        $grupo = Grupo::create([
            'nome_grupo' => $data['nome_grupo'],
            'id_turma' => $turma->id_turma,
            'status_grupo' => 'ativo',
        ]);

        $grupo->usuarios()->syncWithoutDetaching([$request->user()->id]);

        return redirect()->route('grupos.show', $grupo)->with('success', 'Grupo criado e vinculado à turma.');
    }

    public function salvarPreferencias(Request $request, Grupo $grupo)
    {
        $user = $request->user();
        $isStaff = $this->isStaff($user);
        $isMember = $grupo->usuarios()->where('users.id', $user->id)->exists();

        abort_unless($isStaff || $isMember, 403);

        if ($grupo->resultadoSorteio()->exists()) {
            return back()->with('success', 'Este grupo ja possui tema sorteado. As preferencias nao podem mais ser alteradas.');
        }

        $data = $request->validate([
            'preferencias' => ['nullable', 'array', 'max:3'],
            'preferencias.*' => [
                'nullable',
                'integer',
                'distinct',
                Rule::exists('temas', 'id_tema')->where('id_turma', $grupo->id_turma),
            ],
        ]);

        $preferencias = collect($data['preferencias'] ?? [])
            ->filter()
            ->values();

        DB::transaction(function () use ($grupo, $preferencias) {
            PreferenciaTema::where('id_grupo', $grupo->id_grupo)->delete();

            foreach ($preferencias as $index => $idTema) {
                PreferenciaTema::create([
                    'id_grupo' => $grupo->id_grupo,
                    'id_tema' => $idTema,
                    'prioridade' => $index + 1,
                ]);
            }
        });

        return back()->with('success', 'Preferencias de tema salvas com sucesso.');
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

    private function isStaff(?User $user): bool
    {
        return in_array(strtolower(trim((string) $user?->tipo)), ['professor', 'coordenador'], true);
    }
}
