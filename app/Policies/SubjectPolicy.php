<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Subject;
use App\Models\User;

class SubjectPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->hasRole, [UserRole::ADMIN, UserRole::TEACHER]);
    }

    public function view(User $user, Subject $subject): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::TEACHER]);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::TEACHER]);
    }

    public function update(User $user, Subject $subject): bool
    {
        return in_array($user->role, [UserRole::ADMIN, UserRole::TEACHER]);
    }

    public function delete(User $user, Subject $subject): bool
    {
        return $user->role === UserRole::ADMIN;
    }
}
