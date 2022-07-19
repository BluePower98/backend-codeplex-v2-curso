<?php

namespace App\Services\Application\Auth;

use Exception;
use App\Events\Auth\ForgotPasswordEmail;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;

class PasswordResetService
{
    private PasswordResetRepositoryInterface $passwordResetRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        PasswordResetRepositoryInterface $passwordResetRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->passwordResetRepository = $passwordResetRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $email
     * @return void
     * @throws Exception
     */
    public function create(string $email): void
    {
        if (!$user = $this->userRepository->findOneByEmail($email)) {
            throw new Exception("El email ingresado no existe", Response::HTTP_BAD_REQUEST);
        }

        $passwordReset = $this->passwordResetRepository->create($email);

        // $user = $this->userRepository->findOneByEmail($email);

        event(new ForgotPasswordEmail($user, $passwordReset));
    }

    /**
     * @param array $params
     * @return void
     */
    public function update(array $params): void
    {
        $token = $params['token'];
        $passwordReset = $this->passwordResetRepository->findOneByToken($token);

        $user = $this->userRepository->findOneByEmail($passwordReset->email);

        $this->userRepository->update(['logclave' => $params['password']], $user->getKey());

        $this->passwordResetRepository->removeByToken($token);
    }

    /**
     * @param string $token
     * @return void
     * @throws Exception
     */
    public function verifyToken(string $token): void
    {
        if (!$this->passwordResetRepository->findOneByToken($token)) {
            throw new Exception(
                'El token proporcionado no existe o ya fue usado anteriormente.',
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * @param string $token
     * @return void
     */
    public function removeByToken(string $token): void
    {
        $this->passwordResetRepository->removeByToken($token);
    }
}
