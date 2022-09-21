<?php 

namespace App\Repositories\Ubigeo;

interface UbigeoRepositoryInterface
{
    public function findAllByUbigeoId(string $ubigeoId): array;
}