<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Auth\AuthenticationException;
use App\Services\Application\Auth\AuthService;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Foundation\Application;

class AuthController extends ApiController
{
    private AuthService $authService;

    public function __construct(
        AuthService $authService
    ) {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      tags={"Auth"},
     *      summary="Iniciar sesión",
     *      operationId="authLogin",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(response=200, description="Inicio de sesión válido"),
     *      @OA\Response(response=400, ref="#/components/responses/Authentication"),
     *      @OA\Response(response=422, ref="#/components/responses/UnprocessableEntity"),
     *      @OA\Response(response=500, ref="#/components/responses/InternalServerError")
     * )
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $response = $this->authService->login($request->all());

        return $this->successResponse($response);
    }

    /**
     * @OA\Get(
     *      path="/api/auth/me",
     *      tags={"Auth"},
     *      summary="Obtener información de usuario autenticado",
     *      operationId="authMe",
     *      security={{"sanctum": {}}},
     *      @OA\Response(response=200, description="Información de usuario obtenida"),
     *      @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
     *      @OA\Response(response=500, ref="#/components/responses/InternalServerError")
     * )
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = $this->authService->me();

        return $this->successResponse($user);
    }

    /**
     * @OA\Post(
     *      path="/api/auth/register",
     *      tags={"Auth"},
     *      summary="Registrar usuario",
     *      operationId="authRegister",
     *      security={{"sanctum": {}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *      ),
     *      @OA\Response(response=200, description="Información de usuario obtenida"),
     *      @OA\Response(response=422, ref="#/components/responses/UnprocessableEntity"),
     *      @OA\Response(response=500, ref="#/components/responses/InternalServerError")
     * )
     *
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $this->authService->register($request->all());

        return $this->showMessage(
            "Sus datos han sido registrados correctamente." .
            "Por favor, revise su correo electrónico para poder activar su cuenta.",
            Response::HTTP_CREATED
        );
    }

    /**
     * @param string $token
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function activateAccount(string $token): Application|RedirectResponse|Redirector
    {
        $this->authService->activateAccount($token);

        return redirect(config('app.frontend_url'));
    }

    /**
     * @OA\Get(
     *      path="/api/auth/logout",
     *      tags={"Auth"},
     *      summary="Cerrar sesión",
     *      operationId="authLogout",
     *      security={{"sanctum": {}}},
     *      @OA\Response(response=200, description="Sesión cerrada correctamente"),
     *      @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
     *      @OA\Response(response=500, ref="#/components/responses/InternalServerError")
     * )
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return $this->showMessage("La sesión del usuario se ha cerrado correctamente.");
    }


    /**
     * @OA\Get(
     *      path="/api/auth/validate-token/{token}",
     *      tags={"Auth"},
     *      summary="Validar token",
     *      operationId="authValidateToken",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *          parameter="token",
     *          name="token",
     *          description="Token de autenticación",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(response=200, description="Token validado"),
     *      @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
     *      @OA\Response(response=500, ref="#/components/responses/InternalServerError")
     * )
     *
     * @param string $token
     * @return JsonResponse
     * @throws Exception
     */
    public function validateToken(string $token): JsonResponse
    {
        $user = $this->authService->validateToken($token);

        return $this->successResponse($user);
    }
}
