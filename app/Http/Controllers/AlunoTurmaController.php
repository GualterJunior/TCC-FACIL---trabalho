<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Turma;
use Illuminate\Http\Request;

class AlunoTurmaController extends Controller
{
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

        if (! $turma) {
            return back()->withErrors(['codigo_turma' => 'Codigo de turma nao encontrado.']);
        }

        if ($turma->status_turma !== 'ativa') {
            return back()->withErrors(['codigo_turma' => 'Esta turma nao esta ativa para entrada de alunos.']);
        }

        $jaEntrou = Grupo::where('id_turma', $turma->id_turma)
            ->whereHas('usuarios', fn ($query) => $query->where('users.id', $request->user()->id))
            ->exists();

        if ($jaEntrou) {
            return redirect()->route('aluno.turmas.index')->with('success', 'Voce ja participa desta turma.');
        }

        $grupo = Grupo::where('id_turma', $turma->id_turma)
            ->where('status_grupo', 'ativo')
            ->withCount('usuarios')
            ->orderBy('usuarios_count')
            ->orderBy('nome_grupo')
            ->first();

        if (! $grupo) {
            return back()->withErrors(['codigo_turma' => 'A turma foi encontrada, mas ainda nao possui grupos ativos. Peca ao professor para criar os grupos.']);
        }

        $grupo->usuarios()->syncWithoutDetaching([$request->user()->id]);

        return redirect()->route('aluno.turmas.index')->with('success', 'Voce entrou na turma e foi vinculado ao grupo '.$grupo->nome_grupo.'.');
    }
}
