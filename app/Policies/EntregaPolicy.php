<?php

namespace App\Policies;

use App\Models\Entrega;
use App\Models\User;

class EntregaPolicy
{
    /**
     * Permite visualizar lista de entregas
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Permite visualizar uma entrega
     */
    public function view(User $user, Entrega $entrega): bool
    {
        return true;
    }

    /**
     * Permite criar entrega
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Permite editar entrega
     */
    public function update(User $user, Entrega $entrega): bool
    {
        return true;
    }

    /**
     * Permite deletar entrega
     */
    public function delete(User $user, Entrega $entrega): bool
    {
        return true;
    }
}
