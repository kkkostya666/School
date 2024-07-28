<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubjectController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return SubjectResource::collection(Subject::all());
    }

    public function show(Subject $subject)
    {
        return SubjectResource::make($subject);
    }

    public function store(SubjectRequest $request)
    {
        $this->authorize('create', Subject::class);

        $subject = Subject::create($request->validated());

        return response()->json([
            'message' => 'Success store new subject',
            'subject' => SubjectResource::make($subject),
        ]);
    }

    public function update(SubjectRequest $request, Subject $subject)
    {
        $this->authorize('update', Subject::class);

        $subject->update($request->validated());

        return response()->json([
            'message' => 'Success update subject',
            'subject' => SubjectResource::make($subject),
        ]);
    }

    public function destroy(Subject $subject)
    {
        $this->authorize('delete', Subject::class);

        $subject->delete();

        return response()->json(['message' => 'Success delete subject']);
    }
}
