<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class UserController extends AdminResourceController
{
    protected string $modelClass = User::class;
    protected string $routeName = 'users';
    protected string $title = 'Usuario';
    protected string $table = 'users';
    protected string $primaryKey = 'id';

    protected function fields(): array
    {
        return [
            'name' => ['label' => 'Nome', 'type' => 'text', 'rules' => ['required', 'string', 'max:255']],
<<<<<<< HEAD
            'email' => ['label' => 'E-mail', 'type' => 'email', 'rules' => ['required', 'email', 'max:255', 'unique:users,email']],
=======
            'email' => ['label' => 'E-mail', 'type' => 'email', 'rules' => ['required', 'email', 'max:255']],
>>>>>>> 89fa71c (correção de bugs)
            'tipo' => ['label' => 'Perfil', 'type' => 'select', 'rules' => ['required', Rule::in(['aluno', 'professor', 'coordenador'])], 'options' => [
                'aluno' => 'Aluno',
                'professor' => 'Professor',
                'coordenador' => 'Coordenador',
            ]],
            'password' => ['label' => 'Senha', 'type' => 'password', 'rules' => ['required', 'string', 'min:8']],
        ];
    }

    protected function rules(?Model $record = null): array
    {
        $rules = parent::rules($record);

        if ($record) {
            $rules['email'] = ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($record->getKey())];
            $rules['password'] = ['nullable', 'string', 'min:8'];
        }

        return $rules;
    }
}
