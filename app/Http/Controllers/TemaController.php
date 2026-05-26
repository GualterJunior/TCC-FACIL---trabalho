<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;

class TemaController extends Controller
{
    public function index()
    {
        // Retorna a interface visual
        return view('aluno.temas.index');
    }

    public function create()
    {
        return view('aluno.temas.create');
    }

    public function store(Request $request)
    {
        // Lógica de salvar no banco...
    }

    public function show(string $id)
    {
        return view('aluno.temas.show');
    }

    public function edit(string $id)
    {
        return view('aluno.temas.edit');
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
