<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;

class TemaController extends Controller
{

    public function index()
    {
        return response()->json(Tema::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'area' => 'required',
            'id_turma' => 'required'
        ]);

        $tema = Tema::create($request->all());

        return response()->json($tema, 201);
    }

    public function show(string $id)
    {
        return response()->json(
            Tema::findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $tema = Tema::findOrFail($id);

        $tema->update($request->all());

        return response()->json($tema);
    }

    public function destroy(string $id)
    {
        Tema::destroy($id);

        return response()->json([
            'message' => 'Tema removido com sucesso'
        ]);
    }
}