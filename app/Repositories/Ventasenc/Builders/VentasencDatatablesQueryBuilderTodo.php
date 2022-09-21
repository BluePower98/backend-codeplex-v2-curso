<?php

namespace App\Repositories\Ventasenc\Builders;

use App\Models\Ventasenc;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VentasencDatatablesQueryBuilderTodo
{
    private Ventasenc $model;
    private Builder $query;

    public function __construct(
        Ventasenc $model,
        Request $request
        )
    {
        
        $this->model=$model;
        $this->request=$request;
    }

    public function getData(): mixed
    {
        // dd('sasasa');
        $this->settingQueryBuilder();
        return Datatables::query($this->query)
        ->make(true)
        ->getData();
    }
    private function settingQueryBuilder(): void {
        $this->query=DB::table("{$this->model->getTable()} AS T1")
            ->select([
                DB::raw('1 AS Ant'),
                DB::raw('0 AS chk'),
                "T1.idempresa",
                "T1.idtipodocumento",
                "T1.serie",
                "T1.numero",
                DB::raw('T2.ruc AS EmisorRuc'),
                DB::raw('T3.direccion AS EmisorDireccionSucursal'),
                DB::raw("'--' AS EmisorDireccionSucursalCodigo"),
                DB::raw("T3.ubigeo AS UbigeoEmisor"),
                DB::raw("T4.codigo_sunat AS DocumentoTipo"),
                DB::raw("T4.descripcioncorta+ '-'+(T1.serie+ '-'+ right(replicate('0',8) + convert(varchar, T1.numero),8) ) AS DocDes"),
                DB::raw("(T1.serie+ '-'+ right(replicate('0',8) + convert(varchar, T1.numero),8)  ) AS DocumentoSerieNumero"),
                DB::raw("concat(T1.rucdni,' - ', T1.razon_social ) as cliente"),
                DB::raw("T1.razon_social AS ClienteRazonSocial"),
                DB::raw("T1.rucdni AS ClienteRuc"),
                DB::raw("IsNull(T1.direccion,'') AS ClienteDireccion"),
                DB::raw("T1.ubigeo as UbigeoClienten"),
                DB::raw("T6.idtipodocidentidad as ClienteTipoDocumento"),
                DB::raw("(CASE T1.idmoneda WHEN 1 THEN 'PEN' ELSE 'USD' END) AS TipoMoneda"),
                "T1.idmoneda",
                DB::raw("CONVERT(varchar,T1.fecha_emision, 103) AS FechaEmisionFormat"),
                DB::raw("T1.fecha_emision AS FechaEmision"),
                DB::raw("(CONVERT(varchar, T1.fecha_vencimiento,126)+'T00:00:00.000')  AS Fac_Vencimiento"),
                DB::raw("T1.total_gravado AS Afecto"),
                DB::raw("T1.total_inafecto AS Inafec"),
                DB::raw("T1.total_exonerado AS Exoner"),
                DB::raw("T1.total_igv AS Igv"),
                DB::raw("T4.codigo_sunat AS codigo_sunat"),
                DB::raw("CASE WHEN T1.anulado is null 
                THEN Case WHEN T4.codigo_sunat ='07' and T1.enviado ='A' 
                Then -T1.total When T4.codigo_sunat ='07' and T1.enviado in ('H','E') Then 0 
                ELSE Case when T1.enviado in ('E') Then 0 else convert(float, T1.total) End End
                WHEN T1.anulado IN ('H','E')  THEN convert(float, T1.total) 
                ELSE 0 END 	AS total_list"),
                DB::raw("T1.total AS Total"),
                DB::raw("T1.total AS TotalGen"),
                DB::raw("Case when T1.descuento_global = 0 then 0 else T1.descuento_global end AS Descue"),
                DB::raw("T1.total_otros_cargos AS Gastos"),
                DB::raw("T1.total_gratuitas AS Gratui"),
                DB::raw("T1.detraccion_total AS DetraccionTotal"),
                DB::raw("T1.detraccion_porcent*100 as DetraccionPorcentaje"),
                DB::raw("T1.detraccion_id as DetraccionCodigo"),
                DB::raw("CASE When T1.retencion_porcent is not null and T1.retencion_total > 0 Then  concat('62|', T1.retencion_porcent,'|', T1.retencion_total,'|', T1.total ) 
                Else '' End As RetencionSomosAgente"),
                DB::raw("CASE When T4.codigo_sunat='07' then 'Si' when T4.codigo_sunat<>'07' and T1.fecha_emision<>T1.fecha_vencimiento then 'Si' 
                else 'No' end as Credito"),
                DB::raw("CASE WHEN T5.codigo_sunat IS NULL THEN '-' ELSE T5.codigo_sunat END AS	ReferenciaDocumentoTipo"),
                DB::raw("CASE WHEN T1.serie_ref is null or T1.numero_ref IS NULL THEN  '-' ELSE (T1.serie_ref+ '-'+ right(replicate('0',8) + convert(varchar, T1.numero_ref ),8) ) END AS
                ReferenciaDocumentoSerieNumero"),
                DB::raw("CASE WHEN T1.idtiponotacredito IS NULL and T1.idtiponotadebito is null THEN NULL 
                ELSE Isnull(T1.idtiponotacredito,'')+Isnull(T1.idtiponotadebito,'') end as Fac_IDMotNotCreDeb,
                 T1.porcentaje_igv*100 as PorcentajeIgv, 'PE' AS EmisorPais"),
                 "T1.enviado",
                 "T1.anulado",
                 DB::raw("Case when T1.anulado is not null then TRIM(T1.enviado+T1.anulado) 
                 else TRIM(T1.enviado) End as Habilitado, 
                 T1.observaciones AS Observacion,
                 T1.placa_vehiculo AS Gui_Placa"),
                 DB::raw("Case when T1.orden_compra Is null then  '-' 
                 Else null end AS Gui_OrdenCompra"),
                 DB::raw("T1.total_percepcion AS PercepcionMonto"),
                 DB::raw("T1.percepcion_base as BasePercep"),
                 DB::raw("T1.total_icbper as OtroCarg"),
                 "T1.error",
                 DB::raw("CONVERT(varchar, T1.fecha_emision,23) as DateEmision"),
                 DB::raw("Case When T1.enviado ='A' Then ( T2.ruc +'-'+T4.codigo_sunat+'-'+T1.serie+ '-'+ right(replicate('0',8) + convert(varchar, T1.numero),8)+'.xml' ) 
                 else '' End as filename"),
                 DB::raw("isnull(T1.cuotas, '') as InfoCuotas"),
                 DB::raw("case when T1.idtipotransaccion = '02' then 1 Else 0 End as Estado")
            ])
            ->join('zg_empresas AS T2',function(JoinClause $join){
                $join->on('T1.idempresa','=','T2.idempresa');
            })
            ->join('zg_sucursales AS T3',function(JoinClause $join){
                $join->on('T1.idempresa','=','T3.idempresa');
                $join->on('T1.idsucursal','=','T3.idsucursal');
            })
            ->join('zg_tiposdocumentos AS T4',function(JoinClause $join){
                $join->on('T1.idempresa','=','T4.idempresa');
                $join->on('T1.idtipodocumento','=','T4.idtipodocumento');
            })
            ->leftJoin('zg_tiposdocumentos AS T5',function(JoinClause $join){
                $join->on('T1.idempresa','=','T5.idempresa');
                $join->on('T1.idtipodocumentoref','=','T5.idtipodocumento');
            })
            ->join('zg_clientes AS T6',function(JoinClause $join){
                $join->on('T1.idempresa','=','T6.idempresa');
                $join->ON('T1.rucdni','=','T6.rucdni');
            });
            $this->addFilters();
    }
    private function addFilters(): void {
        if($companyId=$this->request->get('idempresa')){
            $this->query=$this->query->where('T1.idempresa',$companyId);
        }
        if($branchId=$this->request->get('idsucursal')){
            $this->query=$this->query->where('T1.idsucursal',$branchId);
        }
        if($typeDocumentid=$this->request->get('idtipodocumento')){
            $this->query=$this->query->where('T1.idtipodocumento','<',5);
        }
        if($desdefecha=$this->request->get('desdefecha')){
            $hastafecha=$this->request->get('hastafecha');
            // dd($hastafecha,$desdefecha);
            // dd($hastafecha);
            $this->query=$this->query->whereBetween('T1.fecha_emision',[$desdefecha,$hastafecha]);
        }
    }


}