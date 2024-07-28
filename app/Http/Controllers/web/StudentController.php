<?php

namespace App\Http\Controllers\web;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Group;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = User::filter($request)->paginate(5);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('create', User::class);

        return view('students.create', ['groups' => Group::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStudentRequest $request)
    {
        $this->authorize('create', [User::class, $request]);

        event(new UserCreated(User::create($request->validated()), $request->password));

        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        $student->load('group');

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $student)
    {
        $this->authorize('update', $student);

        $groups = Group::all();

        return view('students.edit', compact('student', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, User $student)
    {
        $this->authorize('update', $student);

        $validatedData = $request->validated();

        if (is_null($validatedData['password'])) {
            unset($validatedData['password']);
        }
        $student->update($validatedData);

        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('student.index');
    }

    public function restore(User $user)
    {
        $this->authorize('restore', User::class);

        $user->restore();

        return redirect()->route('users.index')->with('status', 'User restored.');
    }

    public function forceDelete(User $user)
    {
        $this->authorize('forceDelete', $user);

        $user->subjects()->detach();
        $user->forceDelete();

        return redirect()->route('users.index')->with('status', 'User permanently deleted.');
    }

    public function exportPdf(User $student, FileService $fileService)
    {
        $this->authorize('pdf', $student);

        $pdfContent = $fileService->viewPdf($student);

        return response()->stream(
            function () use ($pdfContent) {
                echo $pdfContent;
            },
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="student-'.$student->id.'.pdf"',
            ]
        );
    }
}
