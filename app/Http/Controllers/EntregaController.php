<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Etapa;
use App\Models\Grupo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class EntregaController extends AdminResourceController
{
    protected string $modelClass = Entrega::class;
    protected string $routeName = 'entregas';
    protected string $title = 'Entrega';
<<<<<<< HEAD
    protected string $table = 'entrega';
=======
    protected string $table = 'entregas';
>>>>>>> 89fa71c (correção de bugs)
    protected string $primaryKey = 'id_entrega';

    protected function fields(): array
    {
        return [
            'id_grupo' => ['label' => 'Grupo', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->grupos()],
            'id_etapa' => ['label' => 'Etapa', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->etapas()],
            'nome_arquivo' => ['label' => 'Nome do arquivo', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'caminho_arquivo' => ['label' => 'Caminho do arquivo', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
            'status_Entrega' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['enviado', 'em_analise', 'aprovado', 'reprovado'])], 'options' => [
                'enviado' => 'Enviado',
                'em_analise' => 'Em analise',
                'aprovado' => 'Aprovado',
                'reprovado' => 'Reprovado',
            ]],
            'observacao' => ['label' => 'Observacao', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
        ];
    }

    private function grupos(): array
    {
        if (! Schema::hasTable('grupos')) {
            return [];
        }

        return Grupo::orderBy('nome_grupo')->pluck('nome_grupo', 'id_grupo')->toArray();
    }

    private function etapas(): array
    {
        if (! Schema::hasTable('etapas')) {
            return [];
        }

        return Etapa::orderBy('ordem_etapa')->pluck('nome_etapa', 'id_etapa')->toArray();
    }
}
