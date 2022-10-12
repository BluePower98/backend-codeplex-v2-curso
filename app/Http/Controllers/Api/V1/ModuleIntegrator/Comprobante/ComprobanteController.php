<?php

namespace App\Http\Controllers\Api\V1\ModuleIntegrator\Comprobante;


// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Comprobante\ComprobanteRequest;
use App\Services\Application\Comprobante\comprobanteService;
use Illuminate\Http\JsonResponse;

class comprobanteController extends ApiController
{
    private comprobanteService $comprobanteservice;
    public function __construct(comprobanteService $comprobanteservice)
    {
        $this->comprobanteservice=$comprobanteservice;
    }

    public function getComprobante(Request $request): JsonResponse
    {
        // dd($request->all());
        $result=$this->comprobanteservice->getComprobante($request->get('idempresa'),$request->get('idtipodocumento'),$request->get('serie'),$request->get('numero'),$request->get('idsucursal'));

        return $this->successResponse($result);
    }
    public function GetVentasDetalleId_Comprobante(Request $request): JsonResponse
    {
        $result=$this->comprobanteservice
        ->getVentasDetalleIdComprobante($request->get('idempresa'),
        $request->get('idtipodocumento'),$request->get('serie'),$request->get('numero'));

        return $this->successResponse($result);
    }
    public function getVentaPagos(Request $request): JsonResponse
    {
        $result=$this->comprobanteservice
        ->getVentaPagos($request->get('idempresa'),
        $request->get('idtipodocumento'),$request->get('serie'),$request->get('numero'));

        return $this->successResponse($result);
    }
       /**
     * Descargar xml de facturación electrónica.
     *
     * @param Request $request
     * @throws BadRequestException
     */
    public function downloadXML(ComprobanteRequest $request)
    {
        // dd($request->all());
        $result = $this->comprobanteservice
        ->getNameByRuc($request->all());

        return response()->file($result['file'], [
            'Content-Disposition' => 'attachment;filename="'. $result['filename'] .'"'
        ]);
    }


    public function getDatoForExcel(Request $request): JsonResponse
    {
        $result=$this->comprobanteservice->getDatoForExcel($request);
        return $this->successResponse($result);
    }
}
