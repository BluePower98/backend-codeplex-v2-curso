<?php

namespace App\Http\Controllers\Api\V1\ModuleIntegrator\Sunat01MethodPayment;

use App\Http\Controllers\Api\ApiController;
use App\Services\Application\Sunat01MethodPayment\Sunat01MethodPaymentService;
use Illuminate\Http\JsonResponse;


// Sunat01MethodPaymentService
// findAll
class Sunat01MethodPaymentController extends ApiController
{
    //
    private Sunat01MethodPaymentService $sunat01methodpaymentservice;

    public function __construct(
        Sunat01MethodPaymentService $sunat01methodpaymentservice
    )
    {
        $this->sunat01methodpaymentservice=$sunat01methodpaymentservice;
    }

    public function findAllSunat01MethodPayment(string $prefijo):JsonResponse
    {
        $result=$this->sunat01methodpaymentservice->findAllSunat01MethodPayment($prefijo);
        return $this->successResponse($result);
    }
}
