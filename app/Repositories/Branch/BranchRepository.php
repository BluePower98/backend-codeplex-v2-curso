<?php

namespace App\Repositories\Branch;

use App\Models\Branch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
}
