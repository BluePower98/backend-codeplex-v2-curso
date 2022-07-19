<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\Sanctum;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "zg_usuarios";
    protected $primaryKey = "idusuario";
    protected $keyType = "string";

    public $incrementing = false;
    public $timestamps = false;

    public function getAuthIdentifier()
    {
        return $this->loglogin;
    }

    public function getAuthPassword()
    {
        return $this->logclave;
    }

    public function tokens()
    {
        return $this->morphMany(Sanctum::$personalAccessTokenModel, 'tokenable', "tokenable_type", "tokenable_id");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idusuarioauth',
        'nombre',
        'loglogin',
        'logclave',
        'activo',
        'foto',
        'idusuarioauthkey',
        'fecharegistro',
        'periodoinifac',
        'periodofinfac',
        'telefono',
        'email_verificacion_codigo',
        'fecha_activacion',
        'fecha_modificacion_pass',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'logclave'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_activacion' => 'datetime',
        'fecha_modificacion_pass' => 'datetime',
    ];
}
