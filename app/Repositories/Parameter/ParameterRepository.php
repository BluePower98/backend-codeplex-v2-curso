<?php 
namespace App\Repositories\Parameter;

use App\Models\Parameter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Helpers\QueryHelper;


class ParameterRepository implements ParameterRepositoryInterface
{
    private  $model;

    public function __construct(Parameter $model){
        $this->model = $model;
    }
    
    public function findOneCompanyId(string $companyId, string $prefijo):array
    {
       
        $result= DB::select("EXEC {$prefijo}_Man_lo_parametros ?,?",
            ['S01',$companyId]);
        return $result;
    }

    public function updateOneParameter(array $params):void
    {
        $result=DB::statement("EXEC {$params['prefijo']}_Man_lo_parametros
        ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?,?",
        ["M02",$params["idempresa"],$params["idtipodocumento"],$params["msj_comprobante"],$params["msj_otros"],
        $params["pie_comprobante"],$params["nro_cuentas"],$params["formato_impresion"],$params["otros_doc_logo"],
        null,null,null,$params["centrar_logo"],$params["idformapago"],null,null,null,null,null,
        $params["espaciodias"],null,$params["acreditar_ventas"],
        $params["imprimir"],$params["vista_previa_movil"],$params["aperturar_caja_ventas"],
        $params["idproducto"],null,$params["pag_margin_left_80mm"],
        $params["text_size_80mm"],$params["impresion_dsto"],$params["sell_multiple_products"]]);
      
    }

    public function getComboSoap(string $prefijo):Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(1);
        $params = QueryHelper::mergeValuesFromProcedureParams(['C01'], $procedureDefinitions);
        $result=DB::select("EXEC {$prefijo}_Man_lo_parametros {$procedureDefinitions}",$params);
        return collect($result);
    }
    public function getComboTypeSoap(string $prefijo):Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(1);
        $params = QueryHelper::mergeValuesFromProcedureParams(['C02'], $procedureDefinitions);
        $result=DB::select("EXEC {$prefijo}_Man_lo_parametros {$procedureDefinitions}",$params);
        return collect($result);
    }
    public function getDateSistemByParameterId(string $parameterId):Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(2);
        $params = QueryHelper::mergeValuesFromProcedureParams(['S12'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 1] = $parameterId;
        $result=DB::select("EXEC CRM_Embudo {$procedureDefinitions}",$params);
        // dd($result);
        return collect($result);
    }
    public function updateDateSistemByParameterId(array $criteria):void
    {
        // dd($criteria);
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(19);
        $params = QueryHelper::mergeValuesFromProcedureParams(['M13'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 18] = isset($criteria['idempresa'])?$criteria['idempresa']:'';
        $params[$countParams - 17] = isset($criteria['produccion'])?$criteria['produccion']:'';
        $params[$countParams - 16] = isset($criteria['fecha_produccion'])?$criteria['fecha_produccion']:'';
        $params[$countParams - 15] = isset($criteria['envio_automatic_fac'])?$criteria['envio_automatic_fac']:'';
        $params[$countParams - 14] = isset($criteria['envio_individual_boletas'])?$criteria['envio_individual_boletas']:'';
        $params[$countParams - 13] = isset($criteria['sunat_ose'])?$criteria['sunat_ose']:'';
        $params[$countParams - 12] = isset($criteria['sol_usuario'])?$criteria['sol_usuario']:'';
        $params[$countParams - 11] = isset($criteria['sol_password'])?$criteria['sol_password']:'';
        $params[$countParams - 10] = isset($criteria['sol_usuario_secundario'])?$criteria['sol_usuario_secundario']:'';
        $params[$countParams - 9] = isset($criteria['sol_password_secundario'])?$criteria['sol_password_secundario']:'';
        $params[$countParams - 8] = isset($criteria['sol_certificado'])?$criteria['sol_certificado']:'';
        $params[$countParams - 2] =isset($criteria['path_certificado'])?$criteria['path_certificado']:'';

        $result=DB::statement("EXEC CRM_Embudo {$procedureDefinitions}",$params);
     
    }

    public function getComboMethodEnvio():Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(1);
        $params = QueryHelper::mergeValuesFromProcedureParams(['C01'], $procedureDefinitions);
        $result=DB::select("EXEC CRM_Embudo {$procedureDefinitions}",$params);
        return collect($result);
    }

    public function gettypedocument(string $parameterId,string $prefijo):Collection
    {
        $result= DB::select("EXEC {$prefijo}_Man_lo_parametros ?,?",
            ['S09',$parameterId]);
        return Collect($result);
    }
}