<?php 
namespace App\Repositories\Ventasenc;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

interface VentasencRepositoryInterface
{
    public function getTipoDocumneto(string $prefijo,string $idempresa):Collection;

    public function datatables(Request $request): Collection;

    // Habilitar facturas  (actualizar enviado='H')
    // Lista de Detalle de Comprobantes para pasar a FacElecronica_2020
    public function getDatoListaDetalleFactura(array $critical): Collection;
    // Quitar Habilitado de facturas
    public function quitarHabilitadoFactura(array $critical): Collection;
    // Actualizar estado
    public function habilitarEstado(array $critical): Collection;


}

