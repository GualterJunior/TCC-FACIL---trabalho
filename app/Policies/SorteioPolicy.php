<?php

namespace App\Policies;

use App\Models\Sorteio;
use App\Models\User;

class SorteioPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function view(User $user, Sorteio $sorteio): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function create(User $user): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function update(User $user, Sorteio $sorteio): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }

    public function delete(User $user, Sorteio $sorteio): bool
    {
        return $user->isProfessor() || $user->isCoordenador();
    }
}
