<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\User;
use App\Models\Validacao;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class ValidacaoController extends AdminResourceController
{
    protected string $modelClass = Validacao::class;
    protected string $routeName = 'validacoes';
    protected string $title = 'Validacao';
    protected string $table = 'validacoes';
    protected string $primaryKey = 'id_validacao';

    protected function fields(): array
    {
        return [
            'id_entrega' => ['label' => 'Entrega', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->entregas()],
            'id_professor' => ['label' => 'Professor', 'type' => 'select', 'rules' => ['required', 'integer'], 'options' => $this->users()],
            'status_validacao' => ['label' => 'Status', 'type' => 'select', 'rules' => ['required', Rule::in(['pendente', 'aprovado', 'reprovado'])], 'options' => [
                'pendente' => 'Pendente',
                'aprovado' => 'Aprovado',
                'reprovado' => 'Reprovado',
            ]],
            'comentario' => ['label' => 'Comentario', 'type' => 'textarea', 'rules' => ['nullable', 'string']],
        ];
    }

    private function entregas(): array
    {
        if (! Schema::hasTable('entrega')) {
            return [];
        }

        return Entrega::orderByDesc('id_entrega')->pluck('nome_arquivo', 'id_entrega')->toArray();
    }

    private function users(): array
    {
        if (! Schema::hasTable('users')) {
            return [];
        }

        return User::orderBy('name')->pluck('name', 'id')->toArray();
    }
}
