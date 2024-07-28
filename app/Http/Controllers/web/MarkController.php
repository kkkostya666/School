<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarkRequets;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $student)
    {
        Gate::authorize('view-grades', $student);
        $subjects = $student->subjects()->withPivot('mark')->get();

        return view('marks.index', compact('student', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $student)
    {
        Gate::authorize('manage-grades', $student);

        $subjectsList = Subject::whereDoesntHave('users', function ($query) use ($student) {
            $query->where('user_id', $student->id);
        })->get();

        return view('marks.create', compact('subjectsList', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarkRequets $request, User $student)
    {
        Gate::authorize('manage-grades', $student);

        $validatedData = $request->validated();
        $student->subjects()->syncWithoutDetaching([$validatedData['subject_id'] => ['mark' => $validatedData['mark']]]);

        return redirect()->route('student.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $student, Subject $subject)
    {
        Gate::authorize('edit-grade', [$student, $subject]);

        $subjectsList = Subject::whereDoesntHave('users', function ($query) use ($student) {
            $query->where('user_id', $student->id);
        })->get();
        $subjectsList->push($subject);
        $mark = $student->subjects()->where('subject_id', $subject->id)->first()->pivot->mark;

        return view('marks.edit', compact('subjectsList', 'student', 'mark', 'subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarkRequets $request, User $student)
    {
        Gate::authorize('edit-grade', [$student, $request->input('subject_id')]);

        $validatedData = $request->validated();
        $student->subjects()->updateExistingPivot($validatedData['subject_id'], ['mark' => $validatedData['mark']]);

        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student, $subjectId)
    {
        Gate::authorize('delete-grade', [$student, $subjectId]);

        $student->subjects()->detach($subjectId);

        return redirect()->route('student.index');
    }
}
