<?php

namespace App\Services\Application\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\Auth\UserActivationEmail;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\Owner\BadRequestException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\PersonalAccessToken\PersonalAccessTokenRepositoryInterface;

class AuthService
{
    private UserRepositoryInterface $userRepository;
    private PersonalAccessTokenRepositoryInterface $personalAccessTokenRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PersonalAccessTokenRepositoryInterface $personalAccessTokenRepository
    ) {
        $this->userRepository = $userRepository;
        $this->personalAccessTokenRepository = $personalAccessTokenRepository;
    }

    /**
     * @param array $params
     * @return array
     * @throws AuthenticationException
     */
    public function login(array $params): array
    {
        $email = $params['email'];

        $user = $this->userRepository->findOneByEmail($email);

        if (!$user || $user->activo !== 1) {
            throw new AuthenticationException('Credenciales de acceso incorrectas.');
        }

        $credentials = [
            'loglogin' => $email,
            'password' =>  $params['password'],
        ];

        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException('Credenciales de acceso incorrectas.');
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return $this->respondWithToken($token);
    }

    /**
     * @return Authenticatable|null
     */
    public function me(): ?Authenticatable
    {
        return Auth::user();
    }

    /**
     * @param array $params
     * @return void
     */
    public function register(array $params): void
    {
        $email = $params['email'];

        $this->userRepository->create($params);

        $user = $this->userRepository->findOneByEmail($email);

        $this->userRepository->generateVerificationEmailCode($user);

        // Send email
        event(new UserActivationEmail($user));
    }

    /**
     * Activate account user by token.
     *
     * @param string $token
     * @return void
     * @throws Exception
     */
    public function activateAccount(string $token): void
    {
        $user = $this->userRepository->findOneByVerificationEmailCode($token);

        if(!$user){
            throw new BadRequestException("Su token de activación de cuenta es incorrecto.");
        }

        $this->userRepository->update([
            'email_verificacion_codigo' => null,
            'fecha_activacion' => Carbon::now(),
            'activo' => 1
        ], $user->getKey());
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Auth::user()->tokens()->delete();
    }

    /**
     * @param string $token
     * @return User
     * @throws Exception
     */
    public function validateToken(string $token): User
    {
        $token = $this->personalAccessTokenRepository->findToken($token);

        if (!$token) {
            throw new UnauthorizedException("Unauthorized.");
        }

        return $token->tokenable;
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @return array
     */
    protected function respondWithToken(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
        ];
    }
}
