<?php

namespace App\Repositories\Company;

use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Repositories\Company\Builders\IntegrationCompanyDatatablesQueryBuilder;

class CompanyRepository implements CompanyRepositoryInterface
{

    private Company $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $userId
     * @return Collection
     */
    public function findAllByUser(string $userId): Collection
    {
        return DB::table("zg_usuariossucursales", "Z")
            ->select([
                "E.idempresa",
                DB::raw("Upper(E.nombrerazon) AS nombrerazon"),
                "E.ruc",
                DB::raw("Upper(E.direccion) AS direccion"),
                "E.email",
                DB::raw("(CASE WHEN E.nombrecomercial = '-' OR E.nombrecomercial = null THEN '' ELSE E.nombrecomercial END) AS nombrecomercial")
            ])
            ->join("zg_empresas AS E", "Z.IdEmpresa", "=", "E.idempresa")
            ->leftJoin("st_ubigeo AS U", "U.idubigeo", "=", "E.ubigeo")
            ->where("Z.idusuario", "=", $userId)
            ->groupBy(["E.idempresa", "E.nombrerazon", "E.ruc", "E.direccion", "E.email", "U.Departamento", "U.distrito", "E.nombrecomercial"])
            ->get();
    }

    public function datatables(string $userId): Collection
    {

        $results=(new IntegrationCompanyDatatablesQueryBuilder($this->model,$userId))->getData();
        return collect($results);
    }

   public function findOneByCompanyId(string $companyId):Collection
    {
        $result= DB::select('EXEC Int_Man_zg_empresas  ?,?,?,?',
            ['S02',NULL,NULL,$companyId]        
        );
        return collect($result);
    }

    public function storeUpdate(array $params):void
    {
        $result=DB::statement("EXEC {$params['prefijo']}_Man_zg_empresas ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?",
                [$params["accion"],$params["idusuario"],$params['idmodulo'],$params["idempresa"],$params["ruc"],$params["nombrerazon"],
                $params["nombrecomercial"],$params["nombrecorto"],$params["direccion"],
                $params["ubigeo"],$params["telefono"],$params["email"],$params["webpage"],
                $params["activo"],$params["logo"],$params["ageret"],$params["ageper"],
                $params["carritocompras"],$params["idrubro"]
            ]);
      
    }

    public function delete(string $companiId):void
    {
        $result=DB::statement('EXEC Int_Man_zg_empresas ?,?,?,?',
        ['M03',NULL,NULL,$companiId]);
    }
}
