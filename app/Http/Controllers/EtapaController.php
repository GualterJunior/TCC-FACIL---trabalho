<?php

namespace App\Http\Controllers;

use App\Models\Etapa;
use App\Models\Turma;
use Illuminate\Support\Facades\Schema;

class EtapaController extends AdminResourceController
{
    protected string $modelClass = Etapa::class;
    protected string $routeName = 'etapas';
    protected string $title = 'Etapa';
    protected string $table = 'etapas';
    protected string $primaryKey = 'id_etapa';

    protected function fields(): array
    {
        return [
            'nome_etapa' => ['label' => 'Nome da etapa', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'descricao' => ['label' => 'Descrição', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
            'prazo_entrega' => ['label' => 'Prazo de entrega', 'type' => 'date', 'rules' => ['required', 'date']],
            'ordem_etapa' => ['label' => 'Ordem', 'type' => 'number', 'rules' => ['required', 'integer', 'min:1']],
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
