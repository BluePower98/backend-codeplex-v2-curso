<?php

namespace App\Http\Controllers\Api\V1\Ventasenc;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Services\Application\Ventasenc\VentasencService;
use Illuminate\Http\JsonResponse;


class VentasencController extends ApiController
{
    private VentasencService $ventasenc;

    public function __construct(
        VentasencService $ventasenc
    )
    {
        $this->ventasenc=$ventasenc;
    }

    public function getTipoDocumneto(string $prefijo,string $idempresa):JsonResponse
    {
        // dd('saassa');
        $result=$this->ventasenc->getTipoDocumneto($prefijo,$idempresa);
        return $this->successResponse($result);
    }

    public function datatables(Request $request): JsonResponse
    {
        $result=$this->ventasenc->datatables($request);
        return $this->datatablesResponse($result);
    }
    public function getDatoListaDetalleFactura(Request $request): JsonResponse
    {
        $result=$this->ventasenc->getDatoListaDetalleFactura($request->all());
        return $this->successResponse($result);
    }
    public function quitarHabilitadoFactura(Request $request): JsonResponse
    {
        $result=$this->ventasenc->quitarHabilitadoFactura($request->all());
        return $this->successResponse($result);
    }
    public function habilitarEstado(Request $request): JsonResponse
    {
        $result=$this->ventasenc->habilitarEstado($request->all());
        return $this->successResponse($result);
    }
}
