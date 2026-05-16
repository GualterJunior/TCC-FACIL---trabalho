<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use Illuminate\Http\Request;

class EtapaController extends Controller
{

    public function index()
    {
        return response()->json(Etapa::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_etapa' => 'required',
            'prazo_entrega' => 'required',
            'id_turma' => 'required'
        ]);

        $etapa = Etapa::create($request->all());

        return response()->json($etapa, 201);
    }

    public function show(string $id)
    {
        return response()->json(
            Etapa::findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $etapa = Etapa::findOrFail($id);

        $etapa->update($request->all());

        return response()->json($etapa);
    }

    public function destroy(string $id)
    {
        Etapa::destroy($id);

        return response()->json([
            'message' => 'Etapa removida'
        ]);
    }
}