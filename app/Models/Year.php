<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $table = 'ct_anio';
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        "idaniopro"
    ];

    public function usesTimestamps(): bool {
        return false;
    }
}
