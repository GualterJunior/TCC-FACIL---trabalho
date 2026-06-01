<?php

namespace App\Http\Controllers;

use App\Models\Sorteio;
use App\Models\Turma;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class SorteioController extends AdminResourceController
{
    protected string $modelClass = Sorteio::class;
    protected string $routeName = 'sorteios';
    protected string $title = 'Sorteio';
    protected string $table = 'sorteios';
    protected string $primaryKey = 'id_sorteio';

    protected function fields(): array
    {
        return [
            'id_turma' => ['label' => 'Turma', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->turmas()],
            'data_sorteio' => ['label' => 'Data do sorteio', 'type' => 'date', 'rules' => ['required', 'date']],
            'status_sorteio' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['agendado', 'realizado', 'cancelado'])], 'options' => [
                'agendado' => 'Agendado',
                'realizado' => 'Realizado',
                'cancelado' => 'Cancelado',
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
