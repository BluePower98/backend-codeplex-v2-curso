<?php

namespace App\Mail;


use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return UserRegisterNotificationMail
     */
    public function build(): UserRegisterNotificationMail
    {
        return $this->subject('Confirma tu Cuenta')
            ->view('mail.users.register-email')
            ->with([
                'user' => $this->user
            ]);
    }
}
