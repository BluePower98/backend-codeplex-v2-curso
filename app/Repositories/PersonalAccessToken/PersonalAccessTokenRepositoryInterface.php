<?php

namespace App\Repositories\PersonalAccessToken;

interface PersonalAccessTokenRepositoryInterface
{
    public function findToken(string $token);
}
