<?php

use App\Http\Controllers\web\GroupController;
use App\Http\Controllers\web\MarkController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\StudentController;
use App\Http\Controllers\web\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('group', GroupController::class);
Route::resource('subject', SubjectController::class);
Route::resource('student', StudentController::class);
Route::prefix('student/mark')->name('mark.')->group(function () {
    Route::get('{student}', [MarkController::class, 'index'])->name('index')->middleware('can:view-grades,student');
    Route::get('add/{student}', [MarkController::class, 'create'])->name('create')->middleware('can:manage-grades,student');
    Route::post('add/{student}', [MarkController::class, 'store'])->name('store')->middleware('can:manage-grades,student');
    Route::get('{student}/{subject}/edit', [MarkController::class, 'edit'])->name('edit')->middleware('can:edit-grade,student,subject');
    Route::put('{student}', [MarkController::class, 'update'])->name('update')->middleware('can:edit-grade,student');
    Route::delete('{student}/{subject}', [MarkController::class, 'destroy'])->name('destroy')->middleware('can:delete-grade,student,subject');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/students/{student}/export-pdf', [StudentController::class, 'exportPdf'])
    ->name('students.exportPdf')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::delete('/users/{user}', [StudentController::class, 'destroy'])->name('user.destroy');
    Route::post('/users/{id}/restore', [StudentController::class, 'restore'])->name('user.restore')->withTrashed();
    Route::delete('/users/{id}/force-delete', [StudentController::class, 'forceDelete'])->name('user.forceDelete')->withTrashed();
});

require __DIR__.'/auth.php';
