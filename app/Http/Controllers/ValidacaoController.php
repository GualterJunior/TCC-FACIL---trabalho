<?php

namespace App\Http\Controllers;

use App\Models\Validacao;
use Illuminate\Http\Request;

class ValidacaoController extends Controller
{
    public function index()
    {
        return view('coordenador_professor.validacoes.index');
    }

    public function create()
    {
        return view('coordenador_professor.validacoes.create');
    }

    public function store(Request $request)
    {
        // Lógica para guardar no banco de dados...
    }

    public function show(string $id)
    {
        return view('coordenador_professor.validacoes.show');
    }

    public function edit(string $id)
    {
        return view('coordenador_professor.validacoes.edit');
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
