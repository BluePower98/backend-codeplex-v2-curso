<?php

namespace App\Listeners\Auth;

use App\Events\Auth\ForgotPasswordEmail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendForgotPasswordEmail
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
     * @param ForgotPasswordEmail $event
     * @return void
     */
    public function handle(ForgotPasswordEmail $event): void
    {
        $user = $event->user;

        Mail::to([$user->loglogin])->send(new ForgotPasswordMail($user, $event->passwordReset));
    }
}
