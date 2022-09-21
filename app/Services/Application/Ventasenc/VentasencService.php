<?php
namespace App\Services\Application\Ventasenc;

use App\Repositories\Ventasenc\VentasencRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class VentasencService
{
    private VentasencRepositoryInterface $repository;

    public function __construct(
        VentasencRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }
    public function getTipoDocumneto(string $prefijo, string $idempresa):Collection
    {
        return $this->repository->getTipoDocumneto($prefijo, $idempresa);
    }

    public function datatables(Request $request): Collection
    {
        return $this->repository->datatables($request);
    }

    public function getDatoListaDetalleFactura(array $critical): Collection
    {
        return $this->repository->getDatoListaDetalleFactura($critical);
    }
    // Quitar Habilitado de facturas
    public function quitarHabilitadoFactura(array $critical): Collection
    {
        return $this->repository->quitarHabilitadoFactura($critical);
    }
    // Actualizar estado
    public function habilitarEstado(array $critical): Collection
    {
        return $this->repository-> habilitarEstado($critical);

    }
}