<?php
namespace App\Repositories\Sunat01MethodPayment;
use Illuminate\Support\Collection;


interface Sunat01MethodPaymentRepositoryInterface
{
    public function findAllSunat01MethodPayment(string $prefijo):Collection;
}