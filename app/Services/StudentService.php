<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StudentService
{
    public function studentsByGrade(Group $group, int $grade)
    {
        $users = $group->load('users.subjects')->users;

        return $users->filter(function (User $user) use ($grade) {
            return $user->subjects->pluck('pivot.mark')->min() == $grade;
        });
    }

    public function averageMarks(Group $group)
    {
        return Subject::with(['users' => function (Builder $query) use ($group) {
            $query->where('group_id', $group->id);
        }])->get();
    }

    public function allStudents(Group $group, int $perPage = 15)
    {
        return $group->load('users')->users()->paginate($perPage);
    }
}
