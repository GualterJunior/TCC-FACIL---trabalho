<?php

namespace App\Http\Controllers;

use App\Models\ResultadoSorteio;
use Illuminate\Http\Request;

class HistoricoSorteioController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $isStaff = in_array(strtolower(trim((string) $user->tipo)), ['professor', 'coordenador'], true);

        $resultados = ResultadoSorteio::with(['sorteio.turma', 'grupo', 'tema'])
            ->when(! $isStaff, function ($query) use ($user) {
                $query->whereHas('grupo.usuarios', fn ($usuarios) => $usuarios->where('users.id', $user->id));
            })
            ->latest('id_resultado')
            ->paginate(12);

        return view('sorteios.historico', compact('resultados', 'isStaff'));
    }
}
