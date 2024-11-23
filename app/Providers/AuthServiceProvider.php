<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Defina qualquer política específica de modelo aqui, se necessário
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Defina as Gates de autorização
        $this->registerPolicies();

        // Gate para verificar se o usuário é admin
        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });

        // Gate para verificar se o usuário é comum (user)
        Gate::define('is-user', function ($user) {
            return $user->role === 'user';
        });
    }
}
