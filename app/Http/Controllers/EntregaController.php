<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    // 1. Mostra a lista de entregas (A tela que estava dando erro)
    public function index()
    {
        // Retorna a interface visual em resources/views/aluno/entregas/index.blade.php
        return view('aluno.entregas.index');
    }

    // 2. Mostra o formulário de envio de trabalho
    public function create()
    {
        // Retorna a interface visual em resources/views/aluno/entregas/create.blade.php
        return view('aluno.entregas.create');
    }

    public function store(Request $request)
    {
        // O código de salvar no banco fica aqui, mas vamos deixar para testar
        // depois que você criar a tabela no banco de dados.
    }

    public function show(string $id)
    {
        return view('aluno.entregas.show');
    }

    public function edit(string $id)
    {
        return view('aluno.entregas.edit');
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
