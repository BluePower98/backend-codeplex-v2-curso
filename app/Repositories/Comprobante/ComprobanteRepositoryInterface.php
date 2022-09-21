<?php

namespace App\Repositories\Comprobante;

use Illuminate\Support\Collection;

interface ComprobanteRepositoryInterface
{
    public function getComprobante(string $idempresa,int $idtipodocumento,string $serie,string $numero,int $idsucursal): Collection;

    public function getVentasDetalleIdComprobante(string $idempresa, int $idtipodocumento,string $serie,string $numero): Collection;

    public function getVentaPagos(string $idempresa,int $idtipodocumento,string $serie, string $numero): Collection;

    public function getNameByRuc(string $ruc);

    public function getDatoForExcel(array $critical):Collection;
}