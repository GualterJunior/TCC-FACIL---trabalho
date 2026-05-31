<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('sistema.users.index');
    }

    public function create()
    {
        return view('sistema.users.create');
    }

    public function store(Request $request)
    {
        // Lógica para guardar no banco de dados...
    }

    public function show(string $id)
    {
        return view('sistema.users.show');
    }

    public function edit(string $id)
    {
        return view('sistema.users.edit');
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
