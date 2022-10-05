<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'zg_modulos';
    protected $primaryKey = 'idmodulo';

    protected $fillable = [
        'desmodulo',
        'activo',
        'subdominio',
        'descripcion',
        'subdominioprod'
    ];


    public function usesTimestamps(): bool {
        return false;
    }
}
