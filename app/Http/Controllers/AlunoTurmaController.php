<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Turma;
use Illuminate\Http\Request;

class AlunoTurmaController extends Controller
{
    private const LIMITE_INTEGRANTES_GRUPO = 3;

    public function index(Request $request)
    {
        $user = $request->user();
        $busca = trim((string) $request->query('busca', ''));

        $minhasTurmas = Turma::whereHas('grupos.usuarios', fn ($query) => $query->where('users.id', $user->id))
            ->with(['grupos' => fn ($query) => $query->whereHas('usuarios', fn ($usuarios) => $usuarios->where('users.id', $user->id))])
            ->orderBy('nome_turma')
            ->get();

        $turmas = collect();

        if ($busca !== '') {
            $turmas = Turma::where('status_turma', 'ativa')
                ->where(function ($query) use ($busca) {
                    $query->where('codigo_turma', 'like', '%'.$busca.'%')
                        ->orWhere('nome_turma', 'like', '%'.$busca.'%');
                })
                ->withCount('grupos')
                ->orderBy('nome_turma')
                ->get();
        }

        return view('aluno.turmas.index', compact('minhasTurmas', 'turmas', 'busca'));
    }

    public function entrar(Request $request)
    {
        $data = $request->validate([
            'codigo_turma' => ['required', 'string', 'max:255'],
        ]);

        $turma = Turma::where('codigo_turma', $data['codigo_turma'])->first();

        // (Melhoria) Para evitar que o aluno “entre aleatoriamente” em um grupo fora das regras,
        // garantimos que a turma tenha grupos ativos com vagas e validamos elegibilidade antes de vincular.
        // A escolha do grupo abaixo passa a respeitar prioridade por menor número de integrantes.

        if (! $turma) {
            return back()->withErrors(['codigo_turma' => 'Código de turma não encontrado.']);
        }

        if ($turma->status_turma !== 'ativa') {
            return back()->withErrors(['codigo_turma' => 'Esta turma não está ativa para entrada de alunos.']);
        }

        $jaEntrou = Grupo::where('id_turma', $turma->id_turma)
            ->whereHas('usuarios', fn ($query) => $query->where('users.id', $request->user()->id))
            ->exists();

        if ($jaEntrou) {
            return redirect()->route('aluno.turmas.index')->with('success', 'Você já participa desta turma.');
        }

        $grupo = Grupo::where('id_turma', $turma->id_turma)
            ->where('status_grupo', 'ativo')
            ->whereDoesntHave('usuarios', function ($q) use ($request) {
                $q->where('users.id', $request->user()->id);
            })
            ->withCount('usuarios')
            ->having('usuarios_count', '<', self::LIMITE_INTEGRANTES_GRUPO)
            ->orderBy('usuarios_count', 'asc')
            ->orderBy('nome_grupo', 'asc')
            ->first();

        if (! $grupo) {
            return redirect()
                ->route('aluno.grupos.create', $turma)
                ->with('success', 'A turma foi encontrada, mas não possui grupos ativos com vagas. Crie seu grupo para continuar.');
        }

        $grupo->usuarios()->syncWithoutDetaching([$request->user()->id]);

        return redirect()->route('aluno.turmas.index')->with('success', 'Você entrou na turma e foi vinculado ao grupo '.$grupo->nome_grupo.'.');
    }
}
