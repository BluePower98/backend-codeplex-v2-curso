<?php

namespace App\Http\Controllers\Api\V1\Integrador\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use App\Services\Application\User\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;



class UserController extends ApiController
{
    //
    private UserService $userService;

    public function __construct(
        UserService $userService
    )
    {
        $this->userService=$userService;
    }

    public function updateToken(Request $request)
    {
        // dd($request->all());
        $this->userService->updateToken($request->all());
        return $this->showMessage(
            "Se creo el Token" .
            Response::HTTP_CREATED
        );
    }
    public function showtoken(User $user):JsonResponse
    {
        $result=$this->userService->showtoken($user->{$user->getKeyName()});
        return $this->successResponse($result);
    }
}
