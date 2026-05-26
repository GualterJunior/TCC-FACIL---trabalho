<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        // Retorna a interface visual
        return view('aluno.grupos.index');
    }

    public function create()
    {
        return view('aluno.grupos.create');
    }

    public function store(Request $request)
    {
        // Lógica de salvar no banco...
    }

    public function show(string $id)
    {
        return view('aluno.grupos.show');
    }

    public function edit(string $id)
    {
        return view('aluno.grupos.edit');
    }

    public function update(Request $request, string $id)
    {
        // Lógica de atualização...
    }

    public function destroy(string $id)
    {
        // Lógica de exclusão...
    }
}
