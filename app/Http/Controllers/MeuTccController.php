<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class MeuTccController extends Controller
{
    public function index(Request $request)
    {
        $grupos = Grupo::with([
            'turma.etapas' => fn ($query) => $query->orderBy('ordem_etapa'),
            'resultadoSorteio.sorteio',
            'resultadoSorteio.tema',
            'progressos.etapa',
            'entregas.etapa',
            'entregas.ultimaValidacao',
        ])
            ->whereHas('usuarios', fn ($query) => $query->where('users.id', $request->user()->id))
            ->orderBy('nome_grupo')
            ->get();

        return view('aluno.meu-tcc.index', compact('grupos'));
    }
}
