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

        return view('coordenador_professor.acompanhamento.index', compact('turmas'));
    }
}
