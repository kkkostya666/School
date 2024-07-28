<?php

namespace App\Jobs;

use App\Mail\UserGradesEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMessageEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public ?int $userId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::when($this->userId, function ($query, $id) {
            $query->where('id', $id);
        })
            ->with(['subjects', 'group'])
            ->get();

        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(new UserGradesEmail($user));
            } catch (\Exception $exception) {
                Log::channel('email')
                    ->critical("For user: {$user->id} \n Error: {$exception->getMessage()}");
            }
        }
    }
}
