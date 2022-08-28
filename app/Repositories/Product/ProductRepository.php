<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\Builders\ProductDatatablesQueryBuilder;
use Exception;
use App\Helpers\QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function findAll(Request $request): array
    {
        // TODO: Cambiar por Eloquent si es que se puede
        $companyId = $request->get('idempresa');
        $productTypeId = $request->get('idtipoproducto');

        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(19);

        $params = QueryHelper::mergeValuesFromProcedureParams(['S01', $companyId], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 14] = $productTypeId;
        $params[$countParams - 1] = "http://{$_SERVER["HTTP_HOST"]}";

        return DB::select("exec Lo_Man_lo_productos {$procedureDefinitions}", $params);
    }

    /**
     * @param Request $request
     * @return Collection
     * @throws Exception
     */
    public function datatables(Request $request): Collection
    {
        $results = (new ProductDatatablesQueryBuilder($this->model, $request))->getData();

        return collect($results);
    }

    /**
     * Crear producto.
     *
     * @param array $params
     * @return Product
     */
    public function store(array $params): Product
    {
        $params["idproducto"] = $this->getLastId($params["idempresa"]);

        $params = $this->mapParamsStoreOrUpdate($params);

        return $this->model->query()->create($params);
    }

    /**
     * Actualizar producto.
     *
     * @param int $productId
     * @param array $params
     * @return void
     */
    public function update(int $productId, array $params): void
    {
        $params = $this->mapParamsStoreOrUpdate($params);

        $this->model->query()
            ->where([
                ["idproducto", "=", $productId],
                ["idempresa", "=", $params['idempresa']],
            ])
            ->update($params);
    }

    /**
     * Obtener id de nuevo producto.
     *
     * @param string $companyId
     * @return int
     */
    private function getLastId(string $companyId): int
    {
        $product = $this->model->query()
            ->where("idempresa", "=", $companyId)
            ->latest("idproducto")->first("idproducto");

        return (int) $product->idproducto + 1;
    }

    /**
     * @param array $params
     * @return array
     */
    private function mapParamsStoreOrUpdate(array $params): array
    {
        if (array_key_exists('activo', $params)) {
            $params['activo'] = (bool) $params['activo'];
        }

        if (array_key_exists('estadoventa', $params)) {
            $params['estadoventa'] = (bool) $params['estadoventa'];
        }

        if (array_key_exists('escombo', $params)) {
            $params['escombo'] = (bool) $params['escombo'];
        }

        if (array_key_exists('icbper', $params)) {
            $params['icbper'] = (bool) $params['icbper'];
        }

        return $params;
    }

    /**
     * @param string $companyId
     * @param int $productTypeId
     * @return int
     */
    public function generateCode(string $companyId, int $productTypeId): int
    {
        return DB::table("lo_productos")
            ->select([
                DB::raw("ISNULL(MAX(CONVERT(DECIMAL(10, 0), codigo)), 0) + 1 AS code")
            ])
            ->whereRaw("codigo IS NOT NULL AND ISNUMERIC(codigo) = 1 AND idempresa='{$companyId}' AND idtipoproducto={$productTypeId}")
            ->first()->code;
    }


    /**
     * @param int $productId
     * @param string $companyId
     * @return void
     */
    public function delete(int $productId, string $companyId): void
    {
        $this->model->query()->where([
            ["idempresa", "=", $companyId],
            ["idproducto", "=", $productId],
        ])->delete();
    }
}
