<?php

namespace App\Http\Controllers\web\Auth;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Models\Group;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', ['groups' => Group::all()]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CreateStudentRequest $request, FileService $fileService): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['avatar'])) {
            $data['avatar'] = $fileService->updateImage($data['avatar']);
        }
        $user = User::create($data);

        event(new Registered($user));
        event(new UserCreated($user, $request->password));

        Auth::login($user);

        return redirect(route('profile.edit', absolute: false));
    }
}
