<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table ="lote";

    protected $fillable = ['id','lot_nombre','lot_fecha_recibido'];


    public function CodigoPCs(){
    	return $this->hasMany('App\CodigoPC','cod_pc_fk_lote','id');
    }

    public function CodigoArticulos(){
    	return $this->hasMany('App\CodigoArticulo','cod_art_fk_lote','id');
    }
}
