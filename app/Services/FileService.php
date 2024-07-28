<?php

namespace App\Services;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class FileService
{
    public $manager;

    public function __construct()
    {
        $this->manager = ImageManager::imagick();
    }

    public function updateImage(Request $request): ?string
    {
        if ($request->hasFile('avatar')) {
            $filePath = $request->file('avatar')->storeAs("avatars/{$request->user()->id}", $request->file('avatar')->getClientOriginalName(), 'avatars');

            $this->scaleImage($filePath, config('image.avatar.scale'), $request->user()->id);

            return $filePath;
        }

        return null;
    }

    public function scaleImage(string $fileName, int $size): void
    {
        $originalPath = Storage::disk('avatars')->path($fileName);
        $newFilePath = Storage::disk('avatars')->path(pathinfo($fileName, PATHINFO_FILENAME)."_{$size}.".pathinfo($fileName, PATHINFO_EXTENSION));

        $this->manager
            ->read($originalPath)
            ->scale(width: $size)
            ->save($newFilePath, $originalPath);

    }

    public function deleteImage(User $user): void
    {
        if (Storage::disk('avatars')->exists("avatars/{$user->id}")) {
            Storage::disk('avatars')->deleteDirectory("avatars/{$user->id}");
        }
    }

    public function viewPdf(User $student)
    {
        return Pdf::loadView('pdf.template', compact('student'))->stream();
    }

    public function dowloadPdf(User $student)
    {
        $filename = now()->timestamp.'.pdf';
        Pdf::loadView('pdf.template', ['student' => $student])
            ->save(Storage::disk('documents')->path($filename));

        return Storage::disk('documents')->url($filename);
    }
}
