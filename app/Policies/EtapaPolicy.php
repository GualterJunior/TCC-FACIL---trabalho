<?php

namespace App\Policies;

use App\Models\Etapa;
use App\Models\User;

class EtapaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function view(User $user, Etapa $etapa): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function create(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function update(User $user, Etapa $etapa): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function delete(User $user, Etapa $etapa): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }
}

