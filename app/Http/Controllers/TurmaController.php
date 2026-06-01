<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class TurmaController extends AdminResourceController
{
    protected string $modelClass = Turma::class;
    protected string $routeName = 'turmas';
    protected string $title = 'Turma';
    protected string $table = 'turmas';
    protected string $primaryKey = 'id_turma';

    protected function fields(): array
    {
        return [
            'nome_turma' => ['label' => 'Nome da turma', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'codigo_turma' => ['label' => 'Codigo', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'semestre' => ['label' => 'Semestre', 'type' => 'text', 'rules' => ['required', 'string', 'max:50']],
            'descricao' => ['label' => 'Descricao', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
            'status_turma' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['ativa', 'inativa'])], 'options' => [
                'ativa' => 'Ativa',
                'inativa' => 'Inativa',
            ]],
            'id_professor' => ['label' => 'Professor', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->users()],
        ];
    }

    private function users(): array
    {
        if (! Schema::hasTable('users')) {
            return [];
        }

        return User::orderBy('name')->pluck('name', 'id')->toArray();
    }
}
