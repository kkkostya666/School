<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Group;
use App\Models\User;

class GroupPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::TEACHER, UserRole::STUDENT]);
    }

    public function view(User $user, Group $group): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::TEACHER, UserRole::STUDENT]);
    }

    public function create(User $user): bool
    {
        return $user->role === UserRole::ADMIN;
    }

    public function update(User $user, Group $group): bool
    {
        return $user->role === UserRole::ADMIN && $user->group_id === $group->id;
    }

    public function delete(User $user, Group $group): bool
    {
        return false;
    }
}
