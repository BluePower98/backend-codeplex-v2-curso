<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $table = 'ct_meses';
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        "idmes",
        "desmes"
    ];

    public function usesTimestamps(): bool {
        return false;
    }
}
