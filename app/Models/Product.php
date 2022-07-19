<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'lo_productos';
    // protected $primaryKey = ["idempresa", "idproducto"];
    protected $primaryKey = "idproducto";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        "idempresa",
        "idproducto",
        "idlinea",
        "idlineasub",
        "idtipoproducto",
        "idsunatt07",
        "codigo",
        "descripcion",
        "activo",
        "infad1",
        "infad2",
        "infad3",
        "porpercepcion",
        "porisc",
        "estadoventa",
        "escombo",
        "imagen1",
        "imagen2",
        "imagen3",
        "imagen4",
        "idsubcategoria",
        "wikimart",
        "xls",
        "icbper",
    ];



//    /**
//     * Set the keys for a save update query.
//     *
//     * @param  Builder  $query
//     * @return Builder
//     */
//    protected function setKeysForSaveQuery($query): Builder
//    {
//        $keys = $this->getKeyName();
//        if(!is_array($keys)){
//            return parent::setKeysForSaveQuery($query);
//        }
//
//        foreach($keys as $keyName){
//            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
//        }
//
//        return $query;
//    }
//
//    /**
//     * Get the primary key value for a save query.
//     *
//     * @param string|null $keyName
//     * @return mixed
//     */
//    protected function getKeyForSaveQuery(?string $keyName = null): mixed
//    {
//        if(is_null($keyName)){
//            $keyName = $this->getKeyName();
//        }
//
//        if (isset($this->original[$keyName])) {
//            return $this->original[$keyName];
//        }
//
//        return $this->getAttribute($keyName);
//    }
}
