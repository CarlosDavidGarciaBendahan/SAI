<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table="imagen";

    protected $fillable = [
    	'id','ima_fk_producto_computador','ima_fk_producto_articulo'
    ];


    public function Producto_Computador(){
    	return $this->belongsTo('App\Producto_Computador','ima_fk_producto_computador','id');
    }

    public function Producto_Articulo(){
    	return $this->belongsTo('App\Producto_Articulo','ima_fk_producto_articulo','id');
    }
}
