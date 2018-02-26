<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Producto extends Model
{
    protected $table ="tipo_producto";

    protected $fillable = ['id','tip_tipo'];

    public function Producto_Computadores(){
    	return $this->hasMany('App\Producto_Computador','pro_com_fk_tipo_producto','id');
    }

    public function Producto_Articulos(){
    	return $this->hasMany('App\Producto_Articulo','pro_art_fk_tipo_producto','id');
    }
}
