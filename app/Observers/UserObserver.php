<?php

namespace App\Observers;

use App\Models\User;
use App\Services\FileService;

class UserObserver
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function updated(User $user)
    {
        if ($user->isDirty('avatar')) {
            $this->fileService->deleteImage($user);
        }
    }

    public function deleted(User $user)
    {
        $this->fileService->deleteImage($user);
    }
}
