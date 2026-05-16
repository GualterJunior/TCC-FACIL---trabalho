<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{

    public function index()
    {
        return response()->json(
            Nota::with([
                'grupo',
                'professor'
            ])->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_grupo' => 'required',
            'id_professor' => 'required',
            'nota' => 'required'
        ]);

        $nota = Nota::create($request->all());

        return response()->json($nota, 201);
    }

    public function show(string $id)
    {
        return response()->json(
            Nota::with([
                'grupo',
                'professor'
            ])->findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $nota = Nota::findOrFail($id);

        $nota->update($request->all());

        return response()->json($nota);
    }

    public function destroy(string $id)
    {
        Nota::destroy($id);

        return response()->json([
            'message' => 'Nota removida'
        ]);
    }
}