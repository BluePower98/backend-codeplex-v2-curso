<?php

namespace App\Repositories\Branch;

use App\Models\Branch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Helpers\QueryHelper;
use App\Repositories\Branch\Builders\BranchCompanyDatatablesQueryBuilder;

class BranchRepository implements BranchRepositoryInterface
{

    private Branch $model;

    public function __construct(Branch $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $companyId
     * @param string $userId
     * @return Collection
     */
    public function findAllByCompanyAndUser(string $companyId, string $userId): Collection
    {
        return DB::table(DB::raw("
                        (
                            SELECT
                                E.idsucursal,
                                E.descripcion,
                                UPPER(ISNULL(E.direccion, '')) AS direccionSuc,
                                ISNULL(E.telefono,'') AS telefonoSuc,
                                ISNULL(E.email,'') AS correoSuc,
                                (CASE WHEN E.ubigeo IS NOT NULL THEN U.departamento+'-'+U.provincia+'-'+U.distrito ELSE '' END ) as distritoSuc,
                                ubigeo
                            FROM
                                zg_usuariossucursales AS Z
                                INNER JOIN zg_sucursales E ON Z.IdEmpresa=E.idempresa AND Z.idsucursal = E.idsucursal
                                LEFT JOIN st_ubigeo U ON E.ubigeo = U.idubigeo
                                WHERE Z.idempresa='{$companyId}' AND Z.idusuario='{$userId}'
                        ) AS t1
                    "))
                ->select([
                    "idsucursal",
                    "descripcion AS sucursal",
                    "direccionSuc",
                    "telefonoSuc",
                    "correoSuc",
                    DB::raw("ISNULL(distritoSuc,'') AS distritoSuc"),
                    "ubigeo"
                ])->get();
    }

    public function findAllSucursalId(string $companyId,string $prefijo):Collection
    {
      
        $result=DB::select("EXEC {$prefijo}_Man_lo_parametros ?,?",
                ['S05',$companyId]);
        return collect($result);
    }

    public function datatables(string $companyId):Collection
    {
        $result=(new BranchCompanyDatatablesQueryBuilder($this->model,$companyId))->getData();
        return collect($result);
    }

    public function storeupdate(array $criterio):void
    {
        
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(14);
        $params = QueryHelper::mergeValuesFromProcedureParams(["{$criterio['opcion']}"], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 13] =$criterio['idempresa'];
        $params[$countParams - 12] =$criterio['idsucursal'];
        $params[$countParams - 11] =$criterio['codigo'];
        $params[$countParams - 10] =$criterio['idzona'];
        $params[$countParams - 9] =$criterio['descripcion'];
        $params[$countParams - 8] =$criterio['cuo'];
        $params[$countParams - 7] =$criterio['direccion'];
        $params[$countParams - 6] =$criterio['telefono'];
        $params[$countParams - 5] =$criterio['email'];
        $params[$countParams - 4] =$criterio['ubigeo'];
        $params[$countParams - 3] =$criterio['principal'];
        $params[$countParams - 2] =$criterio['responsable'];
        $params[$countParams - 1] =$criterio['activo'];
        $result=DB::statement("EXEC {$criterio['prefijo']}_Man_zg_sucursales {$procedureDefinitions}",$params);
    }

    public function show(string $companyId,int $branchId,string $prefijo):Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(3);
        $params = QueryHelper::mergeValuesFromProcedureParams(['S02'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 2] =$companyId;
        $params[$countParams - 1] =$branchId;
        $result=DB::select("EXEC {$prefijo}_Man_zg_sucursales {$procedureDefinitions}",$params);
        return collect($result);
    }

    public function updatelogo(array $params):void
    {
        $this->model->query()
                    ->where("idempresa","=",$params["idempresa"])
                    ->where("idsucursal","=",$params["idsucursal"])
                    ->update(["logo"=>$params["logo"]]);
    }

    public function getOneBranchCompayIdBranchId(string $companyId,int $branchId,string $prefijo):Collection
    {
        $result=DB::select("EXEC {$prefijo}_Man_zg_sucursales ?,?,?",
        ['S08',$companyId,$branchId]);
        return collect($result);
    }

    public function delete(string $prefijo,string $companyId,int $brachId):Collection
    {
        $result=DB::select("EXEC {$prefijo}_Man_zg_sucursales ?,?,?",
        ['M03',$companyId,$brachId]);
        return collect($result);
    }
}
