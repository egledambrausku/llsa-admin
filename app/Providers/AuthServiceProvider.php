<?php

namespace App\Providers;

use App\Role;
use App\User;
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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Coaches
        Gate::define('coach_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('coach_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('coach_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('coach_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('coach_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Clubs
        Gate::define('club_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('club_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('club_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('club_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('club_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Kids
        Gate::define('kid_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('kid_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('kid_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('kid_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('kid_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Competitions
        Gate::define('competition_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('competition_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('competition_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('competition_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('competition_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Groups
        Gate::define('group_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('group_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('group_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('group_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('group_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
