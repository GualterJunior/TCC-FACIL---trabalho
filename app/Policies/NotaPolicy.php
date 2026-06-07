<?php

namespace App\Policies;

use App\Models\Nota;
use App\Models\User;

class NotaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function view(User $user, Nota $nota): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function create(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function update(User $user, Nota $nota): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function delete(User $user, Nota $nota): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }
}

