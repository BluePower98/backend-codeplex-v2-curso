<?php

namespace App\Repositories\ZonePrice;

use App\Models\ZonePrice;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ZonePriceRepository extends BaseRepository implements ZonePriceRepositoryInterface
{


    public function __construct(ZonePrice $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $productId
     * @param string $companyId
     */
    public function delete(int $productId, string $companyId): void
    {
        $this->model->query()->where([
            ["idempresa", "=", $companyId],
            ["idproducto", "=", $productId],
        ])->delete();
    }

    /**
     * @param int $productId
     * @param string $companyId
     * @return Collection
     */
    public function findAllByProductAndCompany(int $productId, string $companyId): Collection
    {
        $table = $this->model->getTable();

        return $this->model->query()
            ->select([
                "{$table}.idempresa",
                "{$table}.idzona",
                "T2.Descripcion AS Deszonas",
                "{$table}.idproducto",
                "{$table}.idmedida",
                "T3.descripcion AS Desmedidas",
                "{$table}.idtipoprecio",
                "T4.Descripcion AS Deszonastipoprecios",
                "{$table}.codigoBarra",
                "{$table}.precioVenta",
                "{$table}.cantidadMinVen",
                "{$table}.incluidoIgv",
                "{$table}.defecto",
                "{$table}.peso_kg",
                "{$table}.idpropiedad1",
                "{$table}.idpropiedad2",
                "{$table}.idpropiedad3",
                "{$table}.costo",
                "{$table}.utilidad_porcen",
                "{$table}.precio_minimo"
            ])
            ->leftJoin("lo_zonas AS T2", "T2.idzona", "=", DB::raw("{$table}.idzona AND T2.idempresa = {$table}.idempresa"))
            ->leftJoin("lo_medidas AS T3", "T3.idmedida", "=", DB::raw("{$table}.idmedida AND T3.idempresa = {$table}.idempresa"))
            ->leftJoin("lo_zonastipoprecios AS T4", "T4.IdTipoPrecio", "=", "{$table}.IdTipoPrecio")
            ->where("{$table}.idempresa", $companyId)
            ->where("{$table}.idproducto", $productId)
            ->get();
    }
}
