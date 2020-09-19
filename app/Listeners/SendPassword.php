<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\SendPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPassword
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param UserCreated $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        $email = $user->email;
        Mail::to($email)->send(new SendPasswordMail($user, $event->password));
    }
}
