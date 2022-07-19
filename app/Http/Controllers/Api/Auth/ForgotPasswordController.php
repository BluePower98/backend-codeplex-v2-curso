<?php

namespace App\Http\Controllers\Api\Auth;

use App\Services\Application\Auth\PasswordResetService;
use Exception;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForgotPasswordController extends ApiController
{

    private PasswordResetService $passwordResetService;

    public function __construct(
        PasswordResetService $passwordResetService
    ) {
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * Send a reset link to the given user.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function sendResetLinkEmail(Request $request): JsonResponse
    {
        $this->passwordResetService->create($request->get('email'));

        return $this->showMessage(
            "Se ha enviado un mensaje a tu correo para continuar con el proceso de cambio de contraseña."
        );
    }
}
