<?php

namespace App\Mail;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public PasswordReset $passwordReset;

    public function __construct(User $user, PasswordReset $passwordReset)
    {
        $this->user = $user;
        $this->passwordReset = $passwordReset;
    }


    /**
     * Build the message.
     *
     * @return ForgotPasswordMail
     */
    public function build(): ForgotPasswordMail
    {
        $redirectUrl = config('app.frontend_url') . "pages/reset-password/{$this->passwordReset->token}";

        return $this->subject('Recuperación de contraseña')
            ->view('mail.users.forgot-password')
            ->with([
                'user' => $this->user,
                'redirect_url' => $redirectUrl
            ]);
    }
}
