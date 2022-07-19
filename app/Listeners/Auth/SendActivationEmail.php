<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserActivationEmail;
use App\Mail\UserRegisterNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendActivationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserActivationEmail $event
     * @return void
     */
    public function handle(UserActivationEmail $event): void
    {
        $user = $event->user;

        Mail::to([$user->loglogin])->send(new UserRegisterNotificationMail($user));
    }
}
