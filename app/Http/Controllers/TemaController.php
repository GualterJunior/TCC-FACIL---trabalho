<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Turma;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class TemaController extends AdminResourceController
{
    protected string $modelClass = Tema::class;
    protected string $routeName = 'temas';
    protected string $title = 'Tema';
    protected string $table = 'temas';
    protected string $primaryKey = 'id_tema';

    protected function fields(): array
    {
        return [
            'titulo' => ['label' => 'Titulo', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'descricao' => ['label' => 'Descricao', 'type' => 'textarea', 'rules' => ['required', 'string']],
            'area' => ['label' => 'Area', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'data_conclusao' => ['label' => 'Data de conclusao', 'type' => 'date', 'rules' => ['nullable', 'date']],
            'status_tema' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['disponivel', 'reservado', 'aprovado'])], 'options' => [
                'disponivel' => 'Disponivel',
                'reservado' => 'Reservado',
                'aprovado' => 'Aprovado',
            ]],
            'id_turma' => ['label' => 'Turma', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->turmas()],
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
