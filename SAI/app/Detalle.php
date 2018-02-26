<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table ="detalle";

    protected $fillable = [
    	'id','det_cantidad','det_total',
    	'det_fk_presupuesto','det_fk_producto_computador','det_fk_producto_articulo'
    ];


    public function Presupuesto(){
    	return $this->belongsTo('App\Presupuesto','det_fk_presupuesto','id');
    }

    public function Producto_Computador(){
    	return $this->belongsTo('App\Producto_Computador','det_fk_producto_computador','id');
    }

    public function Producto_Articulo(){
    	return $this->belongsTo('App\Producto_Articulo','det_fk_producto_articulo','id');
    }
}
