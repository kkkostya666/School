<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            return response()
                ->json(['token' => Auth::user()
                    ->createToken('API Token')->accessToken], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        if (Auth::user()) {
            Auth::user()->token()->revoke();

            return response()->json(['message' => 'Successfully logged out'], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);
        $request->user()->update($data);

        return response()->json(['message' => 'Password reset successfully'], 200);
    }
}
