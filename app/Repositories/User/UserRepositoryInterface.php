<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findOneByEmail(string $email): ?User;

    public function findOneById(int $id): ?User;

    public function findOneByVerificationEmailCode(string $token): ?User;

    public function create(array $params): void;

    public function update(array $params, int $id): ?int;

    public function generateVerificationEmailCode(User $user): void;

    public function hello(): string;
}
