<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table ="modelo";

    protected $fillable = ['id','mod_modelo','mod_fk_marca'];

    public function Marca(){
    	return $this->belongsTo('App\Marca','mod_fk_marca','id');
    }

    public function Producto_Computadores(){
    	return $this->hasMany('App\Producto_Computador','pro_com_fk_modelo','id');
    }

    public function Producto_Articulos(){
    	return $this->hasMany('App\Producto_Articulo','pro_art_fk_modelo','id');
    }
}
