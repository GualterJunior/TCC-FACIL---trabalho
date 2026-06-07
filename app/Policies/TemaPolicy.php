<?php

namespace App\Policies;

use App\Models\Tema;
use App\Models\User;

class TemaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function view(User $user, Tema $tema): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function create(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function update(User $user, Tema $tema): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function delete(User $user, Tema $tema): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }
}

