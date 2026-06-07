<?php

namespace App\Providers;

use App\Models\Entrega;
use App\Policies\EntregaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Entrega::class => EntregaPolicy::class,
        \App\Models\Turma::class => \App\Policies\TurmaPolicy::class,
        \App\Models\Nota::class => \App\Policies\NotaPolicy::class,
        \App\Models\Etapa::class => \App\Policies\EtapaPolicy::class,
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Grupo::class => \App\Policies\GrupoPolicy::class,
        \App\Models\Tema::class => \App\Policies\TemaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
