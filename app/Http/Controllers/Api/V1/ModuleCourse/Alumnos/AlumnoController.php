<?php

namespace App\Http\Controllers\Api\V1\ModuleCourse\Alumnos;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Application\ModuleCourse\Alumnos\AlumnosService;
use App\Http\Controllers\Api\ApiController;

class AlumnoController extends ApiController
{
    private AlumnosService $AlumnosService;

    public function __construct(

        AlumnosService $AlumnosService,

    )
    {

        $this->AlumnosService = $AlumnosService;

    }

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->AlumnosService->datatables($request);
        return $this->datatablesResponse($result);
    }

    public function store(Request $request): JsonResponse
    {
        $result = $this->AlumnosService->store($request);

        return $this->successResponse($result,"Alumno registrado Correctamente");
    }

    public function update(Request $request, string $idempresa, string $idalumno): JsonResponse
    {
        $result = $this->AlumnosService->update($request, $idempresa, $idalumno);
        return $this->successResponse($result, "Alumno actualizado correctamente");
    }

    public function delete(string $idempresa, string $idalumno): JsonResponse
    {
        $result = $this->AlumnosService->delete($idempresa, $idalumno);

        return $this->successResponse($result, "El Alumno seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, string $idalumno): JsonResponse
    {
        $result = $this->AlumnosService->show($idempresa, $idalumno);

        return $this->successResponse($result,"El Alumno seleccionado a traido los datos correctamente");
    }
}
