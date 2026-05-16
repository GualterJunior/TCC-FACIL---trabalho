<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{

    public function index()
    {
        return response()->json(
            Grupo::with('usuarios')->get()
        );
    }

    public function store(Request $request)
    {
        $grupo = Grupo::create($request->all());

        return response()->json($grupo, 201);
    }

    public function show(string $id)
    {
        return response()->json(
            Grupo::with('usuarios')->findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $grupo = Grupo::findOrFail($id);

        $grupo->update($request->all());

        return response()->json($grupo);
    }

    public function destroy(string $id)
    {
        Grupo::destroy($id);

        return response()->json([
            'message' => 'Grupo removido'
        ]);
    }
}