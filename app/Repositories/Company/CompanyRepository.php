<?php

namespace App\Repositories\Company;

use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
}
