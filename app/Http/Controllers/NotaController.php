<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Nota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class NotaController extends AdminResourceController
{
    protected string $modelClass = Nota::class;
    protected string $routeName = 'notas';
    protected string $title = 'Nota';
    protected string $table = 'notas';
    protected string $primaryKey = 'id_nota';

    public function minhas(Request $request)
    {
        $notas = Nota::with(['grupo.turma', 'professor'])
            ->whereHas('grupo.usuarios', fn ($usuarios) => $usuarios->where('users.id', $request->user()->id))
            ->latest('id_nota')
            ->paginate(10);

        return view('notas.minhas', compact('notas'));
    }

    protected function fields(): array
    {
        return [
            'id_grupo' => ['label' => 'Grupo', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->grupos()],
            'id_professor' => ['label' => 'Professor', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->users()],
            'nota' => ['label' => 'Nota', 'type' => 'number', 'rules' => ['required', 'numeric', 'min:0', 'max:10']],
            'comentario' => ['label' => 'Comentário', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
        ];
    }

    private function grupos(): array
    {
        if (! Schema::hasTable('grupos')) {
            return [];
        }

        return Grupo::orderBy('nome_grupo')->pluck('nome_grupo', 'id_grupo')->toArray();
    }

    private function users(): array
    {
        if (! Schema::hasTable('users')) {
            return [];
        }

        return User::whereIn('tipo', ['professor', 'coordenador'])->orderBy('name')->pluck('name', 'id')->toArray();
    }
}
