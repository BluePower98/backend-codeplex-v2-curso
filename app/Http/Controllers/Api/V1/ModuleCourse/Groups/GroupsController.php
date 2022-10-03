<?php

namespace App\Http\Controllers\Api\V1\ModuleCourse\Groups;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Application\ModuleCourse\Groups\GroupsService;
use App\Http\Controllers\Api\ApiController;

class GroupsController extends ApiController
{
    private GroupsService $GruposService;

    public function __construct(
        GroupsService $GruposService,
    )
    {
        $this->GruposService = $GruposService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->GruposService->datatables($request);

        return $this->datatablesResponse($result);

    }

    public function store(Request $request): JsonResponse
    {
        $result = $this->GruposService->store($request);

        return $this->successResponse($result,"Grupo registrado Correctamente");
    }

    public function update(Request $request, string $idempresa, int $idgrupo): JsonResponse
    {

        $result = $this->GruposService->update($request, $idempresa, $idgrupo);

        return $this->successResponse($result, "Grupo actualizado Correctamente");
    }

    public function delete(string $idempresa, int $idgrupo): JsonResponse
    {
        $result = $this->GruposService->delete($idempresa, $idgrupo);

        return $this->successResponse($result,"El Grupo seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $idgrupo): JsonResponse
    {
        $result = $this->GruposService->show($idempresa, $idgrupo);

        return $this->successResponse($result,"El Grupo seleccionado a traido los datos correctamente");
    }

    public function getCursos(string $idempresa): JsonResponse
    {
        $result = $this->GruposService->getCursos($idempresa);

        return $this->successResponse($result,"El Grupo seleccionado a traido los datos de Cursos");
    }

    public function getMondedas(): JsonResponse
    {
        $result = $this->GruposService->getMondedas();

        return $this->successResponse($result,"El Grupo seleccionado a traido los datos de Monedas");
    }


}
