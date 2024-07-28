<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::TEACHER, UserRole::STUDENT]);
    }

    public function view(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::TEACHER, UserRole::STUDENT]);
    }

    public function create(User $user, User $model): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return $model->role !== UserRole::ADMIN;
        }

        if ($user->role === UserRole::TEACHER) {
            return $model->role === UserRole::STUDENT && $user->group_id === $model->group_id;
        }

        if ($user->role === UserRole::STUDENT) {
            return false;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return $model->role !== UserRole::ADMIN;
        }

        if ($user->role === UserRole::TEACHER) {
            return $model->role === UserRole::STUDENT && $user->group_id === $model->group_id;
        }

        if ($user->role === UserRole::STUDENT) {
            return false;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->role === UserRole::ADMIN && $model->role !== UserRole::ADMIN && $user->group_id === $model->group_id;
    }

    public function destroy(User $authUser, User $user)
    {
        if ($authUser->role === UserRole::ADMIN) {
            return $authUser->group_id === $user->group_id && $user->role !== UserRole::ADMIN;
        }

        return $authUser->role === UserRole::TEACHER && $authUser->group_id === $user->group_id && $user->role === UserRole::STUDENT;
    }

    public function restore(User $authUser, User $user)
    {
        return $authUser->role == UserRole::ADMIN;
    }

    public function forceDelete(User $authUser, User $user)
    {
        return $authUser->role == UserRole::ADMIN && $user->role !== UserRole::ADMIN;
    }
}
