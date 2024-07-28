<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\Subject;

class AssignRandomGrades
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $data = Subject::all()->mapWithKeys(function ($subject) {
            return [
                $subject->id => [
                    'mark' => rand(2, 5),
                ],
            ];
        })->toArray();
        $event->user->subjects()->sync($data, false);
    }
}
