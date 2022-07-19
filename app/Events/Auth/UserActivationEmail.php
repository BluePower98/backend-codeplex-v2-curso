<?php

namespace App\Events\Auth;

use App\Events\Event;
use App\Models\User;

class UserActivationEmail extends Event
{

    public User $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
