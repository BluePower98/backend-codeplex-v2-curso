<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'zg_modulos';
    protected $primaryKey = 'idmodulo';

    protected $fillable = [
        'desmodulo',
        'activo'
    ];

    public function usesTimestamps(): bool {
        return false;
    }
}
