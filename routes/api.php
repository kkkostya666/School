<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\GroupController;
use App\Http\Controllers\api\MarkController;
use App\Http\Controllers\api\SubjectController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout')->middleware('auth:api');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('api.reset-password')->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::resource('groups', GroupController::class);
    Route::resource('subjects', SubjectController::class);

    Route::resource('users', UserController::class)->except([
        'create',
        'edit',
    ]);
    Route::name('users.')->prefix('users/')->group(function () {
        Route::get('/{user}/export', [UserController::class, 'exportPdf'])->name('export');
        Route::post('/{user}/restore', [UserController::class, 'restore'])->name('restore')->withTrashed();
        Route::delete('/{user}/forceDelete', [UserController::class, 'forceDelete'])->name('forceDelete')->withTrashed();
    });

    Route::resources(['users.subjects' => MarkController::class],
        ['except' => [
            'edit',
            'create',
            'show',
        ],
        ]);
    Route::get('users/{user}/export-cv', [UserController::class, 'exportCV']);
});
