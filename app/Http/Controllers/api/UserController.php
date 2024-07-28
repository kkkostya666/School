<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return UserResource::collection(User::with('group')->get());
    }

    public function show(User $user)
    {
        return UserResource::make($user);
    }

    public function store(CreateStudentRequest $request)
    {
        $this->authorize('create', User::class);

        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return response()->json([
            'message' => 'Success store new subject',
            'subject' => UserResource::make($user),
        ]);
    }

    public function update(UpdateStudentRequest $request, User $user)
    {
        $this->authorize('update', User::class);

        $user->update($request->validated());

        return response()->json([
            'message' => 'Success update subject',
            'subject' => UserResource::make($user),
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json(['message' => 'Success delete subject']);
    }

    public function restore(User $user)
    {
        $this->authorize('restore', User::class);

        $user->restore();

        return response()->json([
            'message' => 'Success restore subject',
            'user' => UserResource::make($user),
        ]);
    }

    public function forceDelete(User $user)
    {
        $this->authorize('forceDelete', $user);

        $user->subjects()->detach();
        $user->forceDelete();

        return response()->json(['message' => 'Success delete subject']);
    }

    public function exportPdf(User $user, FileService $service)
    {
        $this->authorize('pdf', $user);

        return response()->json(['link' => $service->dowloadPdf($user)]);
    }
}
