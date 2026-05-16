<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{

    public function index()
    {
        $turmas = Turma::all();

        return response()->json($turmas);
    }

    public function store(Request $request)
    {

        $request->validate([
            'nome_turma' => 'required',
            'codigo_turma' => 'required|unique:turmas',
            'semestre' => 'required',
            'id_professor' => 'required'
        ]);

        $turma = Turma::create([
            'nome_turma' => $request->nome_turma,
            'codigo_turma' => $request->codigo_turma,
            'semestre' => $request->semestre,
            'descricao' => $request->descricao,
            'status_turma' => 'ativa',
            'id_professor' => $request->id_professor
        ]);

        return response()->json([
            'message' => 'Turma criada com sucesso',
            'data' => $turma
        ], 201);
    }

    public function show(string $id)
    {
        $turma = Turma::findOrFail($id);

        return response()->json($turma);
    }

    public function update(Request $request, string $id)
    {
        $turma = Turma::findOrFail($id);

        $turma->update($request->all());

        return response()->json([
            'message' => 'Turma atualizada com sucesso',
            'data' => $turma
        ]);
    }

    public function destroy(string $id)
    {
        $turma = Turma::findOrFail($id);

        $turma->delete();

        return response()->json([
            'message' => 'Turma removida com sucesso'
        ]);
    }
}