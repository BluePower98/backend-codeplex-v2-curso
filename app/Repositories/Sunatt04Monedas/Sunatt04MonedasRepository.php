<?php
namespace App\Repositories\Sunatt04Monedas;

use App\Models\Sunatt04Monedas;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class Sunatt04MonedasRepository implements Sunatt04MonedasRepositoryInterface
{
    private Sunatt04Monedas $mode;

    public function __construct(Sunatt04Monedas $modal)
    {
        
    }

    public function findAllSunatt04Moneda():Collection
    {
       
        $result=DB::select('EXEC Lo_Man_lo_zonas ?',
        ['S03']);
        // dd($result);
        return collect($result);
    }
}