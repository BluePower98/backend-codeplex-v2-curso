<?php

namespace App\Repositories\ModuleCourse\Comments\Builders;

use App\Models\Comments;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CommentsDatatablesQueryBuilder
{
    private Comments $model;
    private Request $request;
    private Builder $query;

    public function __construct(Comments $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

   public function getData(): mixed
   {
    $this->settingQueryBuilder();

    return Datatables::query($this->query)
    ->make(true)
    ->getData();
   } 

   private function settingQueryBuilder(): void {
    $this->query = DB::table("{$this->model->getTable()} AS T1")
        ->select([
            DB::raw("T1.idempresa"),
            DB::raw("ISNULL(T1.idcomentarios,'')  AS idcomentarios"),
            DB::raw("ISNULL(T1.email,'') AS email"),
            DB::raw("ISNULL(T1.mensaje,'') AS mensaje"),
            DB::raw("ISNULL(CONVERT(VARCHAR,T1.fecha,23),'')  AS fecha"),
            DB::raw("ISNULL(T1.activo,'') AS activo"),

        ]);

        $this->addFilters();
 }
 private function addFilters(): void {
    if ($idempresa = $this->request->get('idempresa')) {
        $this->query = $this->query->where('T1.idempresa', $idempresa);
       
    }       
 }
}