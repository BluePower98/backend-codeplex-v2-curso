<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDescription extends Model
{
    protected $table = 'zg_planes_desc';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idplan",
        "idmodulo",
        "orden",
        "descripcion",
        "activo"
    ];
}
