<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Group;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'student' => $request->user(),
            'groups' => Group::all(),
            'avatar' => $request->user()->avatar_url,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateStudentRequest $request, FileService $service): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $service->updateImage($request);
        }
        $request->user()->fill(array_filter($data));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
