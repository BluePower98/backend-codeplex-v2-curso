<?php

namespace App\Services\Application\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserService
{
    private UserRepositoryInterface $repository;

    public function __construct(
        UserRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findOneByEmail(string $email): ?User
    {
        return $this->repository->findOneByEmail($email);
    }

    /**
     * @param string $token
     * @return User|null
     */
    public function findOneByVerificationEmailCode(string $token): ?User
    {
        return $this->repository->findOneByVerificationEmailCode($token);
    }
}
