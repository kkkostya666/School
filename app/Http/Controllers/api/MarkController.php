<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarkRequets;
use App\Http\Resources\MarkResource;
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

        return MarkResource::collection($student->subjects()->withPivot('mark')->get());
    }

    public function store(MarkRequets $request, User $student)
    {
        Gate::authorize('manage-grades', $student);

        $data = $request->validated();
        $student->subjects()->sync([Subject::find($data['subject_id'])->id => ['mark' => $data['mark']]], false);

        return response()->json(['message' => 'Mark successfully created!']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MarkRequets $request, User $student)
    {
        Gate::authorize('edit-grade', [$student, $request->input('subject_id')]);

        $student->subjects()->sync([$student->id => ['mark' => $request->get('mark')]], false);

        return response()->json(['message' => 'Mark successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student, $subjectId)
    {
        Gate::authorize('delete-grade', [$student, $subjectId]);

        $student->subjects()->detach($subjectId);

        return response()->json(['message' => 'Mark successfully deleted!']);
    }
}
