<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        return response()->json(
            User::all()
        );
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'tipo' => 'required'
        ]);

        $user = User::create([

            'name' => $request->name,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'tipo' => $request->tipo,

            'status_usuario' => 'ativo'

        ]);

        return response()->json([
            'message' => 'Usuário criado com sucesso',
            'data' => $user
        ], 201);
    }


    public function show(string $id)
    {
        return response()->json(

            User::with([
                'turmas',
                'grupos',
                'validacoes',
                'notas'
            ])->findOrFail($id)

        );
    }

    public function update(Request $request, string $id)
    {

        $user = User::findOrFail($id);

        $dados = $request->all();

        if ($request->password) {

            $dados['password'] = Hash::make($request->password);
        }

        $user->update($dados);

        return response()->json([
            'message' => 'Usuário atualizado com sucesso',
            'data' => $user
        ]);
    }

    public function destroy(string $id)
    {

        User::destroy($id);

        return response()->json([
            'message' => 'Usuário removido com sucesso'
        ]);
    }
}
