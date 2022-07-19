<?php

namespace App\Http\Controllers\Api\V1\Logistic\Maintainers\ProductType;

use App\Helpers\QueryHelper;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProductTypeController extends ApiController
{


    public function index(): JsonResponse
    {
        $procedureParams = QueryHelper::generateSyntaxPHPToProcedureParams(19);

        $params = QueryHelper::mergeValuesFromProcedureParams(['S03'], $procedureParams);

        $results = DB::select("exec Lo_Man_lo_productos {$procedureParams}", $params);

        return $this->successResponse($results);
    }
}
