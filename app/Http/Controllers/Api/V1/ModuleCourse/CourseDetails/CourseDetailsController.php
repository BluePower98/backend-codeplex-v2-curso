<?php

namespace App\Http\Controllers\Api\V1\ModuleCourse\CourseDetails;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Application\ModuleCourse\CourseDetails\CourseDetailsService;
use App\Http\Controllers\Api\ApiController;

class CourseDetailsController extends ApiController
{
    private CourseDetailsService $CursosDetailsService;

    public function __construct(
        CourseDetailsService $CursosDetailsService,
    )
    {
        $this->CursosDetailsService = $CursosDetailsService;
    } 

    public function datatables(Request $request): JsonResponse
    {
        $result = $this->CursosDetailsService->datatables($request);

        return $this->datatablesResponse($result);

    }

    public function store(Request $request): JsonResponse
    {
        $result = $this->CursosDetailsService->store($request);

        return $this->successResponse($result,"Detalle de Curso registrado Correctamente");
    }

    public function update(Request $request, string $idempresa, int $iddetallecurso): JsonResponse
    {

        $result = $this->CursosDetailsService->update($request, $idempresa, $iddetallecurso);

        return $this->successResponse($result, "Detalle de Curso actualizado Correctamente");
    }

    public function delete(string $idempresa, int $iddetallecurso): JsonResponse
    {
        $result = $this->CursosDetailsService->delete($idempresa, $iddetallecurso);

        return $this->successResponse($result,"El Detalle Curso seleccionado se ha eliminado correctamente.");
    }

    public function show(string $idempresa, int $iddetallecurso): JsonResponse
    {
        $result = $this->CursosDetailsService->show($idempresa, $iddetallecurso);

        return $this->successResponse($result,"El Detalle Curso seleccionado a traido los datos correctamente");
    }

    public function getCursos(string $idempresa): JsonResponse
    {
        $result = $this->CursosDetailsService->getCursos($idempresa);

        return $this->successResponse($result,"El Detalle de Curso seleccionado a traido los datos de Cursos");
    }

    public function getEspecialidades(string $idempresa,  int $idespecialidad): JsonResponse
    {
        $result = $this->CursosDetailsService->getEspecialidades($idempresa, $idespecialidad);

        return $this->successResponse($result,"El Detalle Curso seleccionado a traido los datos de Especialidades");
    }
}