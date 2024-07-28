<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;

class SendUserNotification
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
        Mail::to($event->user->email)->send(new RegisterMail($event->user, $event->password));
    }
}
