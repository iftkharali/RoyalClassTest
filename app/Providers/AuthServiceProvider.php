<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\AdminPolicy;
use App\Policies\UserPolicy;
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

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('manage-user-posts', [UserPolicy::class, 'manage']);
        Gate::define('manage-users', [AdminPolicy::class, 'manageUsers']);
        Gate::define('manage-posts', [AdminPolicy::class, 'managePosts']);

    }
}
