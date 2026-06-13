<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Validacao;

class ValidacaoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function view(User $user, Validacao $validacao): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function create(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function update(User $user, Validacao $validacao): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function delete(User $user, Validacao $validacao): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }
}
