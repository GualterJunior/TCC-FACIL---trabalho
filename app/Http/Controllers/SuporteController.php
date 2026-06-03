<?php

namespace App\Http\Controllers;

use App\Models\Suporte;
use App\Models\Turma;
use Illuminate\Http\Request;

class SuporteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $isStaff = in_array(strtolower(trim((string) $user->tipo)), ['professor', 'coordenador'], true);

        $suportes = Suporte::with(['usuario', 'turma'])
            ->when(! $isStaff, fn ($query) => $query->where('id_usuario', $user->id))
            ->latest('id_suporte')
            ->paginate(10);

        return view('suportes.index', compact('suportes', 'isStaff'));
    }

    public function create()
    {
        $turmas = Turma::where('status_turma', 'ativa')->orderBy('nome_turma')->pluck('nome_turma', 'id_turma');

        return view('suportes.create', compact('turmas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_turma' => ['nullable', 'integer'],
            'assunto' => ['required', 'string', 'max:255'],
            'mensagem' => ['required', 'string'],
        ]);

        $data['id_usuario'] = $request->user()->id;
        $data['status_suporte'] = 'aberto';

        Suporte::create($data);

        return redirect()->route('suportes.index')->with('success', 'Solicitacao de suporte enviada.');
    }

    public function show(Request $request, string $id)
    {
        $suporte = Suporte::with(['usuario', 'turma'])->findOrFail($id);
        $isStaff = in_array(strtolower(trim((string) $request->user()->tipo)), ['professor', 'coordenador'], true);

        if (! $isStaff && $suporte->id_usuario !== $request->user()->id) {
            abort(403);
        }

        return view('suportes.show', compact('suporte', 'isStaff'));
    }

    public function update(Request $request, string $id)
    {
        $suporte = Suporte::findOrFail($id);

        $data = $request->validate([
            'status_suporte' => ['required', 'in:aberto,respondido,encerrado'],
            'resposta' => ['nullable', 'string'],
        ]);

        $suporte->update($data);

        return redirect()->route('suportes.show', $suporte)->with('success', 'Suporte atualizado.');
    }
}
