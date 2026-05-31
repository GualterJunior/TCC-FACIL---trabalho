<?php

namespace App\Http\Controllers;

use App\Models\Sorteio;
use Illuminate\Http\Request;

class SorteioController extends Controller
{

    public function index()
    {
        return response()->json(
            Sorteio::with('resultados')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_turma' => 'required'
        ]);

        $sorteio = Sorteio::create([
            'id_turma' => $request->id_turma,
            'data_sorteio' => now(),
            'status_sorteio' => 'realizado'
        ]);

        return response()->json($sorteio, 201);
    }

    public function show(string $id)
    {
        return response()->json(
            Sorteio::with('resultados')->findOrFail($id)
        );
    }

    public function destroy(string $id)
    {
        Sorteio::destroy($id);

        return response()->json([
            'message' => 'Sorteio removido'
        ]);
    }
}