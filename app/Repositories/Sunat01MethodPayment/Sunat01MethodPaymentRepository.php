<?php
namespace App\Repositories\Sunat01MethodPayment;

use App\Models\Sunat01MethodPayment;
use Illuminate\Support\Collection;

use App\Helpers\QueryHelper;
use Illuminate\Support\Facades\DB;


class Sunat01MethodPaymentRepository implements Sunat01MethodPaymentRepositoryInterface
{

    public function __construct(Sunat01MethodPayment $model)
    {
        $this->model=$model;
    }

    public function findAllSunat01MethodPayment(string $prefijo):Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(1);
        $params = QueryHelper::mergeValuesFromProcedureParams(['S08'], $procedureDefinitions);
        $result=DB::select("EXEC {$prefijo}_Man_lo_parametros {$procedureDefinitions}",$params);
        return collect($result);
    }
}