<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function updateRole(User $user)
    {
        return ! ($user->hasRole(UserRole::STUDENT) || $user->hasRole(UserRole::TEACHER));
    }
}
