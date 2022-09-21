<?php

namespace App\Services\Application\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

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

    public function updateToken(array $params):void
    {
        $token_beta='';
        $token_estable='';
        $user=Auth::user();
        // $token = $user->createToken('API Token')->plainTextToken;
        $token_beta=$user->createToken('API Token')->plainTextToken;
        $token_estable=$user->createToken('API Token')->plainTextToken;

        $result=[
            'token_beta'=>$token_beta,
            'token_estable'=>$token_estable,
            'idusuario'=>$params['idusuario']
        ];
         $this->repository->updateToken($result);
    }

    public function showtoken(string $iduser):array
    {
        return $this->repository->showtoken($iduser);
    }
}
