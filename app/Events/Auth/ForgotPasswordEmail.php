<?php

namespace App\Events\Auth;

use App\Events\Event;
use App\Models\PasswordReset;
use App\Models\User;

class ForgotPasswordEmail extends Event
{
    public User $user;
    public PasswordReset $passwordReset;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, PasswordReset $passwordReset)
    {
        $this->user = $user;
        $this->passwordReset = $passwordReset;
    }
}
