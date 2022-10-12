<?php

namespace App\Http\Controllers\Api\V1\ModuleIntegrator\Sunatt04Monedas;



use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Services\Application\Sunatt04Monedas\Sunatt04MonedasServices;
// use App\Services\Sunatt04Monedas\Sunatt04MonedasServices;

use Illuminate\Http\JsonResponse;
class Sunatt04MonedasController extends ApiController
{
    //
    private Sunatt04MonedasServices $sunatprecio;

    public function __construct(Sunatt04MonedasServices $sunatprecio)
    {
        $this->sunatprecio=$sunatprecio;
    }

    public function findAllSunatt04Moneda():JsonResponse
    {
        // dd('sasa');
        $results=$this->sunatprecio->findAllSunatt04Moneda();
        return $this->successResponse($results);
    }
}
