<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'cur_comentarios';
    protected $primaryKey = "idempresa";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "idcomentarios",
        "email",
        "mensaje",
        "fecha",
        "activo"      
    ];
}