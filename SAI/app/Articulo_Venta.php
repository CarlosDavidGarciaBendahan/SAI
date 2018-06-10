<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo_Venta extends Model
{
    protected $table ="articulo_venta";

    protected $fillable = [
    	'art_ven_fk_codigoarticulo','art_ven_fk_venta','precio_unitario'
    ];



    public function Venta(){
    	return $this->belongsTo('App\Venta','art_ven_fk_venta','id');
    }

    public function codigoArticulo(){
    	return $this->belongsTo('App\codigoArticulo','art_ven_fk_codigoarticulo','id');
    }
}
