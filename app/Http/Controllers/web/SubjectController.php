<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('subjects.index', ['subjects' => Subject::filter($request)->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Subject::class);

        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        $this->authorize('create', Subject::class);

        Subject::create($request->validated());

        return redirect()->route('subject.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $this->authorize('update', $subject);

        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $this->authorize('update', $subject);

        $subject->update($request->validated());

        return redirect()->route('subject.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);

        $subject->delete();

        return redirect()->route('subject.index');
    }
}
