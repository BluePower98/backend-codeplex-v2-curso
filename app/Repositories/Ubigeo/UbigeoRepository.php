<?php

namespace App\Repositories\Ubigeo;

use App\Models\Ubigeo;
use Illuminate\Support\Facades\DB;

class UbigeoRepository implements UbigeoRepositoryInterface
{
    private Ubigeo $ubigeo;

    public function __construct(Ubigeo $model)
    {
        $this->model=$model;    
    }

    public function findAllByUbigeoId(string $idubigeo): array
    {
        return DB::select('EXEC Man_st_ubigeo ?,?,?',['S04',NULL,$idubigeo]);
    }
}