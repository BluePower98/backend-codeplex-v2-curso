<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'zg_planes';
    protected $primaryKey = 'idplan';
    public $timestamps = false;

    protected $fillable = [
        "idmodulo",
        "descripcion",
        "precio",
        "imgagenplan",
        "diasdemo",
        "nroempresas",
        "nrousuarios",
        "nrodocumentos",
        "color",
        "activo"
    ];
}
