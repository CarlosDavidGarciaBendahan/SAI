<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico_Falta_Stock extends Model
{
    protected $table = "historico_falta_stock";

    protected $fillable = [
    	'id','cantidad_faltante','precio_unitario',
    	'cotizacion_dolar','fk_presupuesto','fk_producto_computador',
    	'fk_producto_articulo'
    ];




    public function Presupuesto(){
    	return $this->belongsTo('App\Presupuesto','fk_presupuesto','id');
    }

    public function Producto_Computador(){
    	return $this->belongsTo('App\Producto_Computador','fk_producto_computador','id');
    }

    public function Producto_Articulo(){
    	return $this->belongsTo('App\Producto_Articulo','fk_producto_articulo','id');
    }
}
