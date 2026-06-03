<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class AcompanhamentoController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $role = strtolower(trim((string) $user->tipo));

        $turmas = Turma::with([
            'etapas' => fn ($query) => $query->orderBy('ordem_etapa'),
            'grupos.usuarios',
            'grupos.resultadoSorteio.tema',
            'grupos.progressos.etapa',
            'grupos.entregas.etapa',
            'grupos.entregas.ultimaValidacao',
        ])
            ->when($role === 'professor', fn ($query) => $query->where('id_professor', $user->id))
            ->orderBy('nome_turma')
            ->get();

        $resumo = [
            'turmas' => $turmas->count(),
            'grupos' => $turmas->sum(fn ($turma) => $turma->grupos->count()),
            'sem_tema' => $turmas->sum(fn ($turma) => $turma->grupos->filter(fn ($grupo) => ! $grupo->resultadoSorteio?->tema)->count()),
            'entregas_pendentes' => $turmas->sum(fn ($turma) => $turma->grupos->sum(fn ($grupo) => $grupo->entregas->filter(fn ($entrega) => ($entrega->ultimaValidacao?->status_validacao ?? 'pendente') === 'pendente')->count())),
        ];

        return view('coordenador_professor.acompanhamento.index', compact('turmas', 'resumo'));
    }
}
