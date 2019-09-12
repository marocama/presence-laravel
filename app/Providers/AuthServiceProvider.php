<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manager', function ($user) {

            if ($user->can == 'manager' || $user->can == 'master'){
                return true;
            }
 
            return false;
 
        });

        Gate::define('master', function ($user) {

            if ($user->can == 'master'){
                return true;
            }
 
            return false;
 
        });
    }
}
