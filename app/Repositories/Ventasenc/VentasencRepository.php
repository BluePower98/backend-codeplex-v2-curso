<?php 

namespace App\Repositories\Ventasenc;
// App\Repositories\Ventasenc\VentasencRepository
use App\Models\Ventasenc;
use App\Repositories\Ventasenc\Builders\VentasencDatatablesQueryBuilder;
use App\Repositories\Ventasenc\Builders\VentasencDatatablesQueryBuilderTodo;
use Illuminate\Support\Collection;
use App\Repositories\Ventasenc\VentasencRepositoryInterface;
    //   use App\Helpers\QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\FileHelper;
use App\Helpers\QueryHelper;

class VentasencRepository implements VentasencRepositoryInterface
{
    private  $model;

    public function __construct(Ventasenc $model){
        $this->model = $model;
    }

    public function getTipoDocumneto(string $prefijo,string $idempresa):Collection
    {
    // VentasencService
    // dd($prefijo);
        $result= DB::select("EXEC {$prefijo}_Proc_facturacion ?,?",
            ['S02',$idempresa]);
        return Collect($result);
    }

    public function datatables(Request $request): Collection
    {
        // dd($this->model,$request->all());
        if(empty($request->get('idtipodocumento')) || $request->get('idtipodocumento')==0){

            $result = (new VentasencDatatablesQueryBuilderTodo($this->model,$request))->getData();
            // dd($result);
            return collect($result);
        }
        $result = (new VentasencDatatablesQueryBuilder($this->model,$request))->getData();
        // dd($result);
        return collect($result);
    }

    public function getDatoListaDetalleFactura(array $critical): Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(6);
        $params = QueryHelper::mergeValuesFromProcedureParams(['M01'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 5] = $critical['idempresa'];
        $params[$countParams - 3] = $critical['idtipodocumento'];
        $params[$countParams - 2] = $critical['serie'];
        $params[$countParams - 1] = $critical['numero'];
        $result=DB::select("EXEC {$critical['prefijo']}_Proc_facturacion {$procedureDefinitions}",$params);
        // dd($result);
        return collect($result);
    }
    // Quitar Habilitado de facturas
    public function quitarHabilitadoFactura(array $critical): Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(6);
        $params = QueryHelper::mergeValuesFromProcedureParams(['M02'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 5] = $critical['idempresa'];
        $params[$countParams - 3] = $critical['idtipodocumento'];
        $params[$countParams - 2] = $critical['serie'];
        $params[$countParams - 1] = $critical['numero'];
        $result=DB::select("EXEC {$critical['prefijo']}_Proc_facturacion {$procedureDefinitions}",$params);
        // dd($result);
        return collect($result);
    }
    // Actualizar estado
    public function habilitarEstado(array $critical): Collection
    {
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(11);
        $params = QueryHelper::mergeValuesFromProcedureParams(['M03'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 10] = $critical['idempresa'];
        $params[$countParams - 8] = $critical['idtipodocumento'];
        $params[$countParams - 7] = $critical['serie'];
        $params[$countParams - 6] = $critical['numero'];
        $params[$countParams - 3] = $critical['enviado'];
        $params[$countParams - 2] = $critical['error'];
        $params[$countParams - 1] = $critical['anulado'];

        $result=DB::select("EXEC {$critical['prefijo']}_Proc_facturacion {$procedureDefinitions}",$params);
        // dd($result);
        return collect($result);
    }
}