<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Turma;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class GrupoController extends AdminResourceController
{
    protected string $modelClass = Grupo::class;
    protected string $routeName = 'grupos';
    protected string $title = 'Grupo';
    protected string $table = 'grupos';
    protected string $primaryKey = 'id_grupo';

    protected function fields(): array
    {
        return [
            'nome_grupo' => ['label' => 'Nome do grupo', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'id_turma' => ['label' => 'Turma', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->turmas()],
            'status_grupo' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['ativo', 'inativo'])], 'options' => [
                'ativo' => 'Ativo',
                'inativo' => 'Inativo',
            ]],
        ];
    }

    private function turmas(): array
    {
        if (! Schema::hasTable('turmas')) {
            return [];
        }

        return Turma::orderBy('nome_turma')->pluck('nome_turma', 'id_turma')->toArray();
    }
}
