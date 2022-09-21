<?php

namespace App\Http\Controllers\Api\V1\Ubigeo;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Ubigeo;
use App\Services\Application\Ubigeo\UbigeoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UbigeoController extends ApiController
{
    //
    private UbigeoService $ubigeoservice;

    public function __construct(UbigeoService $ubigeoservice)
    {
        $this->ubigeoservice=$ubigeoservice;
    }
    /**
     *
     * @param   Ubigeo  $ubigeo 
     * @return  JsonResponse
     */
    public function findAllByUbigeoId(string $ubigeo):JsonResponse{
        // dd('DDFDF');
        $result=$this->ubigeoservice->findAllByUbigeoId($ubigeo);
        return $this->successResponse($result);
    }
}
