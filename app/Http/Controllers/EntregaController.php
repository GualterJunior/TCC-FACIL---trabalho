<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use Illuminate\Http\Request;

class EntregaController extends Controller
{

    public function index()
    {
        return response()->json(
            Entrega::with([
                'grupo',
                'etapa',
                'validacoes'
            ])->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_grupo' => 'required',
            'id_etapa' => 'required',
            'nome_arquivo' => 'required',
            'caminho_arquivo' => 'required'
        ]);

        $entrega = Entrega::create([
            'id_grupo' => $request->id_grupo,
            'id_etapa' => $request->id_etapa,
            'nome_arquivo' => $request->nome_arquivo,
            'caminho_arquivo' => $request->caminho_arquivo,
            'status_entrega' => 'enviado',
            'observacao' => $request->observacao
        ]);

        return response()->json($entrega, 201);
    }

    public function show(string $id)
    {
        return response()->json(
            Entrega::with([
                'grupo',
                'etapa',
                'validacoes'
            ])->findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $entrega = Entrega::findOrFail($id);

        $entrega->update($request->all());

        return response()->json($entrega);
    }

    public function destroy(string $id)
    {
        Entrega::destroy($id);

        return response()->json([
            'message' => 'Entrega removida com sucesso'
        ]);
    }
}
