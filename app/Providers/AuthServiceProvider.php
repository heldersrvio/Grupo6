<?php

namespace equipac\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         //'equipac\Model' => 'equipac\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
         Gate::define('supervisor', function ($user) {
            if ($user->nivel == 1) {
                return true;
            }
            return false;
         });
         Gate::define('bolsista', function ($user) {
            if ($user->nivel == 2) {
                return true;
            }
            return false;
         });
         Gate::define('usuario', function ($user) {
            if ($user->nivel == 3) {
                return true;
            }
            return false;
         });
         Gate::define('admin', function ($user) {
            if ($user->nivel == 0) {
                return true;
            }
            return false;
         });
    }
}
