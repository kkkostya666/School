<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\User;
use App\Policies\RolePolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::define('update-role', [RolePolicy::class, 'updateRole']);

        Gate::define('view-grades', function (User $user) {
            return $user->hasRole(UserRole::STUDENT) || $user->hasRole(UserRole::ADMIN) || $user->hasRole(UserRole::TEACHER)
                ? Response::allow()
                : Response::deny('Вы не авторизованы для просмотра оценок.');
        });

        Gate::define('manage-grades', function (User $user, User $student) {
            return ($user->hasRole(UserRole::ADMIN) || $user->hasRole(UserRole::TEACHER)) && $user->group_id === $student->group_id
                ? Response::allow()
                : Response::deny('Вы должны быть администратором или учителем в этой группе.');
        });

        Gate::define('edit-grade', function (User $user, User $student) {
            return in_array($user->role, [UserRole::ADMIN, UserRole::TEACHER]) && $user->group_id === $student->group_id
                ? Response::allow()
                : Response::deny('Вы должны быть администратором или учителем и принадлежать к одной группе со студентом.');
        });

        Gate::define('delete-grade', function (User $user, User $student) {
            return in_array($user->role, [UserRole::ADMIN, UserRole::TEACHER]) && $user->group_id === $student->group_id
                ? Response::allow()
                : Response::deny('Вы должны быть администратором или учителем и принадлежать к одной группе со студентом.');
        });

        Gate::define('pdf', function (User $user) {
            return $user->hasRole(UserRole::ADMIN) || $user->hasRole(UserRole::TEACHER)
                ? Response::allow()
                : Response::deny('Вы не авторизованы для просмотра оценок.');
        });
    }
}
