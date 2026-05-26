<?php

namespace App\Http\Controllers;

use App\Models\Validacao;
use Illuminate\Http\Request;

class ValidacaoController extends controller
{

    public function index()
    {
        return response()->json(
            Validacao::with([
                'entrega',
                'professor'
            ])->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_entrega' => 'required',
            'id_professor' => 'required',
            'status_validacao' => 'required'
        ]);

        $validacao = Validacao::create($request->all());

        return response()->json($validacao, 201);
    }

    public function show(string $id)
    {
        return response()->json(
            Validacao::with([
                'entrega',
                'professor'
            ])->findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $validacao = Validacao::findOrFail($id);

        $validacao->update($request->all());

        return response()->json($validacao);
    }

    public function destroy(string $id)
    {
        Validacao::destroy($id);

        return response()->json([
            'message' => 'Validação removida'
        ]);
    }
}
