<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// Usa tu modelo y política:
use App\Models\Viaje;
use App\Policies\ViajePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Las políticas de autorización para la aplicación.
     *
     * @var array
     */
    protected $policies = [
        Viaje::class => ViajePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
