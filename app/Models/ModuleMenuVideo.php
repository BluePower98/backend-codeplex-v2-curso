<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleMenuVideo extends Model
{
    protected $table = 'zg_modulo_menu_video';
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'idmodulo',
        'idmenu',
        'descripcion',
        'url'
    ];

}
