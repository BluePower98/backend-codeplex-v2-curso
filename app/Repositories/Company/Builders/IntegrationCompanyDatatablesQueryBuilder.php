<?php 
namespace App\Repositories\Company\Builders;

use App\Models\Company;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Query\JoinClause;


class IntegrationCompanyDatatablesQueryBuilder
{
    private Company $model;
    private Builder $query;
    public function __construct(Company $model,string $userId)
    {
        $this->model=$model;
        $this->iduserId=$userId;
       
    }
        /**
     * @return  mixed  
     * @throws Exception
     */
    public function getData(): mixed
    {
        $this->settingQueryBuilder();
        // dd($this->iduserId);
        // dd($this->query);
        return Datatables::query($this->query)
        // ->filterColumn('T1.idempresa',function(Builder $query, $keyword){
        //     $query->where("T1.idempresa","LIKE","{$keyword}");
        // })
        // ->filterColumn('nombrecomercial',function($query,$keyword){
        //     $sql="ISNULL(T1.nombrecomercial,'') LIKE ?";
        //     $query->whereRaw($sql,["%{$keyword}%"]);
        // })
        // ->filterColumn('email',function($query,$keyword){
        //     $sql="ISNULL(T1.email,'') LIKE ?";
        //     $query->whereRaw($sql,["%{$keyword}%"]);
        // })
        ->make(true)
        ->getData();
        // return Datatables::of(DB::select('EXEC MAN_int_con_empresas ?,?,?',
        // ['S01',null,$this->iduserId]))
        //     ->make(true);
    }
    /**
     * @return  void  
     */
    private function settingQueryBuilder():void{
        //  $this->query=DB::select('EXEC MAN_int_con_empresas ?,?,?',
        // ['S01',null,$this->iduserId]);
        $this->query = DB::table("{$this->model->getTable()} AS T1")
            ->select([
                DB::raw("T1.idempresa"),
                DB::raw("ISNULL(T1.ruc,'')  AS ruc"),
                'T1.nombrerazon',
                DB::raw("ISNULL(T1.nombrecomercial,'') AS nombrecomercial"),
                DB::raw("ISNULL(T1.nombrecorto,'') AS nombrecorto"),
                DB::raw("ISNULL(T1.direccion,'')  AS direccion"),
                'T1.ubigeo',
                DB::raw("ISNULL(T1.telefono,'')  AS telefono"),
                DB::raw("ISNULL(T1.email,'')  AS email"),
                DB::raw("ISNULL(T1.webpage,'')  AS webpage"),
                DB::raw("ISNULL(T1.activo,'')  AS activo") 
            ])
            ->Join('zg_usuariossucursales AS Z',function(JoinClause $join){
                $join->on('Z.idempresa','=','T1.idempresa');
            });
            $this->addFilters();
    }
    /** 
     * @return  void 
     */
    private function addFilters():void{

        if($idusuario=$this->iduserId){
            $this->query=$this->query->where('Z.idusuario',$idusuario)->DISTINCT();
        }
    }
}