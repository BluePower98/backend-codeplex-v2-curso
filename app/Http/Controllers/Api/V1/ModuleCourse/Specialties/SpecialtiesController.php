<?php

namespace App\Http\Controllers\Api\V1\ModuleCourse\Specialties;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Application\ModuleCourse\Specialties\SpecialtiesService;
use App\Http\Controllers\Api\ApiController;

class SpecialtiesController extends ApiController
{
    private SpecialtiesService $EspecialidadesService;

    public function __construct(
        SpecialtiesService $EspecialidadesService,
    ) 
    {
        $this->EspecialidadesService = $EspecialidadesService;
    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->EspecialidadesService->datatables($request);

        return $this->datatablesResponse($result);

    }

    public function store(Request $request): JsonResponse
    {
        $result = $this->EspecialidadesService->store($request);

        return $this->successResponse($result,"Especialidad registrado Correctamente");
    }

    public function update(Request $request, string $idempresa, int $idespecialidad): JsonResponse
    {

        $result = $this->EspecialidadesService->update($request, $idempresa, $idespecialidad);

        return $this->successResponse($result, "Especialidad actualizado Correctamente");
    }

    public function delete(string $idempresa, int $idespecialidad): JsonResponse
    {
        $result = $this->EspecialidadesService->delete($idempresa, $idespecialidad);

        return $this->successResponse($result,"La Especialidad seleccionada se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $idespecialidad): JsonResponse
    {
        $result = $this->EspecialidadesService->show($idempresa, $idespecialidad);

        return $this->successResponse($result,"La Especialidad seleccionado a traido los datos correctamente");
    }
}
