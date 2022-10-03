<?php

namespace App\Http\Controllers\Api\V1\ModuleCourse\Comments;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Application\ModuleCourse\Comments\CommentsService;
use App\Http\Controllers\Api\ApiController;

class commentsController extends ApiController
{
    private CommentsService $ComentariosService;

    public function __construct(
        CommentsService $ComentariosService,
    ) 

    {
        $this->ComentariosService = $ComentariosService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->ComentariosService->datatables($request);

        return $this->datatablesResponse($result);

    }

    public function store(Request $request): JsonResponse
    {
        $result = $this->ComentariosService->store($request);
        return $this->successResponse($result,"Comentario registrado Correctamente");
    }

    public function update(Request $request, string $idempresa, int $idcomentarios): JsonResponse
    {

        $result = $this->ComentariosService->update($request, $idempresa, $idcomentarios);

        return $this->successResponse($result, "Comentario actualizado Correctamente");
    }

    public function delete(string $idempresa, int $idcomentarios): JsonResponse
    {
        $result = $this->ComentariosService->delete($idempresa, $idcomentarios);

        return $this->successResponse($result,"El Comentario seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $idcomentarios): JsonResponse
    {
        $result = $this->ComentariosService->show($idempresa, $idcomentarios);

        return $this->successResponse($result,"El Comentario seleccionado a traido los datos correctamente");
    }
}
