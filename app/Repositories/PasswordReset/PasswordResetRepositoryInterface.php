<?php

namespace App\Repositories\PasswordReset;

use App\Models\PasswordReset;

interface PasswordResetRepositoryInterface
{
    public function create(string $email): PasswordReset;

    public function findOneByToken(string $token): ?PasswordReset;

    public function removeByToken(string $token): void;
}
