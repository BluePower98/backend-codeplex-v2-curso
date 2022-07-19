<?php

namespace App\Repositories\PersonalAccessToken;

use Laravel\Sanctum\PersonalAccessToken;

class PersonalAccessTokenRepository implements PersonalAccessTokenRepositoryInterface
{

    protected PersonalAccessToken $model;

    public function __construct(PersonalAccessToken $model)
    {
        $this->model = $model;
    }

    /**
     * Find the token instance matching the given token.
     *
     * @param string $token
     * @return PersonalAccessToken|null
     */
    public function findToken(string $token)
    {
        return $this->model->findToken($token);
    }
}
