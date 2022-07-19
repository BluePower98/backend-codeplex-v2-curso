<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    protected $table = 'lo_medidas';
    // protected $primaryKey = ["idempresa", "idmedida"];
    protected $primaryKey = "idmedida";
    public $incrementing = false;

    protected $fillable = [
        "idempresa",
        "idmedida",
        "descripcion",
        "sunatcodigo",
        "equivalencia"
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
