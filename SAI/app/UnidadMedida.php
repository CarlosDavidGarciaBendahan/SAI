<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table ="unidadmedida";

    protected $fillable = ['id','uni_medida'];

    public function Producto_Articulos(){
    	return $this->hasMany('App\Producto_Articulo','pro_art_fk_unidadmedida','id');
    }
}
