<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index()
    {
        return view('coordenador_professor.turmas.index');
    }

    public function create()
    {
        return view('coordenador_professor.turmas.create');
    }

    public function store(Request $request)
    {
        // Lógica para guardar no banco de dados...
    }

    public function show(string $id)
    {
        return view('coordenador_professor.turmas.show');
    }

    public function edit(string $id)
    {
        return view('coordenador_professor.turmas.edit');
    }

    public function update(Request $request, string $id)
    {
        // Lógica para atualizar...
    }

    public function destroy(string $id)
    {
        // Lógica para remover...
    }
}
