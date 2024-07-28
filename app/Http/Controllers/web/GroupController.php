<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Services\StudentService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        return view('groups.index', ['groups' => Group::filter($request)->paginate(5)]);
    }

    public function create()
    {
        $this->authorize('store', Group::class);

        return view('groups.create');
    }

    public function store(GroupRequest $request)
    {
        $this->authorize('store', Group::class);

        Group::create($request->validated());

        return redirect()->route('group.index');
    }

    public function show(Group $group, StudentService $studentService)
    {
        $subjectStudent = $studentService->averageMarks($group);
        $greatStudents = $studentService->studentsByGrade($group, 5);
        $goodStudents = $studentService->studentsByGrade($group, 4);
        $allStudents = $studentService->allStudents($group, 10);

        return view('groups.show', compact('group', 'subjectStudent', 'greatStudents', 'goodStudents', 'allStudents'));
    }

    public function edit(Group $group)
    {
        $this->authorize('edit', $group);

        return view('groups.edit', compact('group'));
    }

    public function update(GroupRequest $request, Group $group)
    {
        $this->authorize('update', $group);

        $group->update($request->validated());

        return redirect()->route('group.index');
    }

    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);

        $group->delete();

        return redirect()->route('group.index');
    }
}
