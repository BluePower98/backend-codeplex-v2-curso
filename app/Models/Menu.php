<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'zg_menus';
    protected $primaryKey = 'idmenu';

    protected $fillable = [
        'codigo_menu',
        'descripcion',
        'type',
        'icontype',
        'idparent',
    ];

    public function usesTimestamps(): bool {
        return false;
    }
}
