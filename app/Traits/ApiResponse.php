<?php

namespace App\Traits;

use App\Helpers\ApiHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{

    /**
     * Crear formato de respuesta JSON para escenarios de éxito.
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @param array $extras
     * @return JsonResponse
     */
    protected function successResponse(
        mixed $data,
        string $message = ApiHelper::MSG_SUCCESSFUL_OPERATION,
        int $code = Response::HTTP_OK,
        array $extras = []
    ): JsonResponse
    {
        return $this->makeResponse($data, $message, $code, $extras);
    }

    /**
     * Crear formato de respuesta JSON para escenarios de error.
     *
     * @param string $message
     * @param int $code
     * @param array $extras
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $code, array $extras = []): JsonResponse
    {
        return $this->makeResponse(null, $message, $code, $extras);
    }

    /**
     * Crear respuesta JSON para mostrar solo la propiedad "message".
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function showMessage(string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        return $this->makeResponse(null, $message, $code);
    }

    /**
     * @param Collection $data
     * @return JsonResponse
     */
    protected function datatablesResponse(Collection $data): JsonResponse
    {
        return $this->successResponse(
            null,
            ApiHelper::MSG_SUCCESSFUL_OPERATION,
            Response::HTTP_OK,
            $data->all()
        );
    }

    /**
     * Retorna en formato JSON la estructura de respuestas definida para la API.
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @param array $extras
     * @return JsonResponse
     */
    private function makeResponse(mixed $data, string $message, int $code, array $extras = []): JsonResponse
    {
        $response = ApiHelper::response($data, $message, $code, $extras);

        return response()->json($response, $code);
    }
}
