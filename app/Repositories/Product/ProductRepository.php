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
     * @param array $params
     * @return Product
     */
    public function store(array $params): Product
    {
        $params["idproducto"] = $this->getLastId($params["idempresa"]);

        return $this->model->query()->create($params);
    }

    /**
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
