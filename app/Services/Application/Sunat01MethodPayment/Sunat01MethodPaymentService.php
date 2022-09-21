<?php

namespace App\Services\Application\Sunat01MethodPayment;

use App\Repositories\Sunat01MethodPayment\Sunat01MethodPaymentRepositoryInterface;
use Illuminate\Support\Collection;


class Sunat01MethodPaymentService
{
    private Sunat01MethodPaymentRepositoryInterface $repostory;
    public function __construct(
        Sunat01MethodPaymentRepositoryInterface $repostory
    )
    {
        $this->repostory=$repostory;
    }
    public function findAllSunat01MethodPayment(string $prefijo):Collection
    {
        $result=$this->repostory->findAllSunat01MethodPayment($prefijo);
        return collect($result);
    }
}