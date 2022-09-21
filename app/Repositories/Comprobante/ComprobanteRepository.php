<?php

namespace App\Repositories\Comprobante;

// use App\Helpers\FileHelper;
// use App\Helpers\QueryHelper;

use App\Helpers\FileHelper;
use App\Helpers\QueryHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ComprobanteRepository implements ComprobanteRepositoryInterface
{
    // private $procedureParams;
    // private $procedureCalling;

    public function __construct()
    {
        
        // $this->procedureParams = QueryHelper::generateSyntaxPHPToProcedureParams(6);
        // $this->procedureCalling = "Exec Lo_Man_lo_ventas_comprobantes {$this->procedureParams}";
        // dd($this->procedureCalling);
    }

    public function getComprobante(string $idempresa,int $idtipodocumento,string $serie,string $numero,int $idsucursal): Collection
    {
        // dd('dfdfdf');

        $result = DB::select(
            'Exec Lo_Man_lo_ventas_comprobantes ?,?,?,?,?,?',
            array(
                'S01',
                $idempresa,
                $idtipodocumento,
                $serie,
                $numero,
                $idsucursal
        ));

        $Ventasenc = current($result);

        // Obtener información de las imágen de logo
        $images = DB::table('zg_sucursales')
            ->where([
                'idempresa' => $idempresa
            ])->where([
                'idsucursal' => $idsucursal
            ])
            ->first();

            $server = env('APP_URL');
            if($images->logo==null){
                $localFile = str_replace($server, '', 'logo.png');
                $pathLocalFile = public_path($localFile);
                
                $Ventasenc->image = FileHelper::getDataURI($pathLocalFile);
                return collect($Ventasenc);

            }else{
                $localFile = str_replace($server, '', $images->logo);
                $pathLocalFile = public_path($localFile);
                // return response()->json($pathLocalFile, Response::HTTP_OK);
                $Ventasenc->image = FileHelper::getDataURI($pathLocalFile);
                return collect($Ventasenc);
            
            }
            return collect($Ventasenc);

            // return collect($Ventasenc);
        // return response()->json([$Ventasenc], Response::HTTP_OK);

        
    }

    public function getVentasDetalleIdComprobante(string $idempresa, int $idtipodocumento,string $serie,string $numero): Collection
    {
        // dd('dfdfdf');
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(6);
        $params = QueryHelper::mergeValuesFromProcedureParams(['S02'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 5] = $idempresa;
        $params[$countParams - 4] = $idtipodocumento;
        $params[$countParams - 3] = $serie;
        $params[$countParams - 2] = $numero;

        // dd($params);
        $result=DB::select("EXEC  Lo_Man_lo_ventas_comprobantes {$procedureDefinitions}",$params);
        // $params = QueryHelper::mergeValuesFromProcedureParams(['S02', $idempresa, $idtipodocumento, $serie, $numero ], $this->procedureParams);
        // $Ventasenc = DB::select($this->procedureCalling, $params);
        
        return collect($result);
    }

    public function getVentaPagos(string $idempresa,int $idtipodocumento,string $serie, string $numero): Collection
    {
        $Mediospago = DB::select('Exec Lo_Man_lo_ventaspagos ?,?,?,?,?,?,?,?,?,?',
        array(
            'S01',
            $idempresa, 
            $idtipodocumento,
            $serie,
            $numero,
            null,
            null,
            null,
            null,
            null
        ));
    return collect($Mediospago);
    }

        // Busco con el ruc en una tabla "X" el nombre de la empresa
        public function getNameByRuc(string $ruc)
        {
            return DB::connection('sqlsrv_facturacion')
                        ->table('Fe_Empresas')
                        ->where(['EmisorRuc' => $ruc])
                        ->first();
            
        }

        public function getDatoForExcel(array $critical):Collection
        {
            $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(8);
            $params = QueryHelper::mergeValuesFromProcedureParams(['S04'], $procedureDefinitions);
            $countParams = count($params);
            $params[$countParams - 7] = $critical['idempresa'];
            $params[$countParams - 6] = $critical['idsucursal'];
            $params[$countParams - 2] = $critical['desdefecha'];
            $params[$countParams - 1] = $critical['hastafecha'];
            $result=DB::select("EXEC {$critical['prefijo']}_Proc_facturacion {$procedureDefinitions}",$params);
            // dd($result);
            return collect($result);
        }




}