<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    use HasFactory;
    protected $table = 'st_ubigeo';
    
    protected $primaryKey = "idubigeo";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable=[
        "idubigeo",
        "departamento",
        "provincia",
        "distrito",
    ];
}
