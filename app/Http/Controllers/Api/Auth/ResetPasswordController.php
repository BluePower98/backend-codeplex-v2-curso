<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\Application\Auth\PasswordResetService;

class ResetPasswordController extends ApiController
{
    private PasswordResetService $passwordResetService;

    public function __construct(
        PasswordResetService $passwordResetService
    )
    {
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * @param string $token
     * @return JsonResponse
     * @throws Exception
     */
    public function verifyToken(string $token): JsonResponse
    {
        $this->passwordResetService->verifyToken($token);

        return $this->showMessage('El token es correcto.');
    }

    /**
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function update(ResetPasswordRequest $request): JsonResponse
    {
        $this->passwordResetService->update($request->all());

        return $this->showMessage('La contraseña ha sido actualizada correctamente.');
    }
}
