<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Nota;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class NotaController extends AdminResourceController
{
    protected string $modelClass = Nota::class;
    protected string $routeName = 'notas';
    protected string $title = 'Nota';
    protected string $table = 'notas';
    protected string $primaryKey = 'id_nota';

    protected function fields(): array
    {
        return [
            'id_grupo' => ['label' => 'Grupo', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->grupos()],
            'id_professor' => ['label' => 'Professor', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->users()],
            'nota' => ['label' => 'Nota', 'type' => 'number', 'rules' => ['required', 'numeric', 'min:0', 'max:10']],
            'comentario' => ['label' => 'Comentario', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
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

        return User::orderBy('name')->pluck('name', 'id')->toArray();
    }
}
