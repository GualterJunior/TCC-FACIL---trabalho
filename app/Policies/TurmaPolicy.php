<?php

namespace App\Policies;

use App\Models\Turma;
use App\Models\User;

class TurmaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function view(User $user, Turma $turma): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function create(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function update(User $user, Turma $turma): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function delete(User $user, Turma $turma): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }
}

