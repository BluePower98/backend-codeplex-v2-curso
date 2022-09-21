<?php

namespace App\Repositories\Zone;

use App\Models\Zone;
use Illuminate\Support\Collection;
use App\Helpers\QueryHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class ZoneRepository implements ZoneRepositoryInterface
{
    private Zone $model;

    public function __construct(Zone $model)
    {
        $this->model = $model;
    }


    /**
     * @param string $companyId
     * @return Collection
     */
    public function findAllByCompany(string $companyId): Collection
    {
        return $this->model->query()
                    ->where("idempresa", "=", $companyId)
                    ->get();
    }

    public function getComboBox(string $companyId,string $prefijo):Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(2);
        $params = QueryHelper::mergeValuesFromProcedureParams(['S03'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 1] = $companyId;
        $result=DB::select("EXEC {$prefijo}_Man_zg_sucursales {$procedureDefinitions}",$params);
        return collect($result);
    }

    public function getZonasSunat04(string $companyId):Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(2);
        $params = QueryHelper::mergeValuesFromProcedureParams(['S01'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 1] = $companyId;
        $result=DB::select("EXEC Lo_Man_lo_zonas {$procedureDefinitions}",$params);
        return collect($result);
    }
    public function storeUpdate(Request $request): Collection
    {
        // dd($request->all());
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(6);
        $params = QueryHelper::mergeValuesFromProcedureParams(["{$request->get('accion')}"], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 5] = $request->get('idempresa');
        $params[$countParams - 4] = $request->get('idzona');
        $params[$countParams - 3] = $request->get('idmoneda');
        $params[$countParams - 2] = $request->get('Descripcion');
        $params[$countParams - 1] = $request->get('wikimart');
        $result=DB::select("EXEC Lo_Man_lo_zonas {$procedureDefinitions}",$params);

        return collect($result);
    }
    public function delete(string $companyId,int $zonaId):Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(3);
        $params = QueryHelper::mergeValuesFromProcedureParams(['M03'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 2] = $companyId;
        $params[$countParams - 1] = $zonaId;
        $result=DB::select("EXEC Lo_Man_lo_zonas {$procedureDefinitions}",$params);
        return collect($result);
    }
}
