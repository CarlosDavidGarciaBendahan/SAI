<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuenteVenta extends Model
{
    protected $table = "fuenteventa";

    protected $fillable = ['id','nombre','descripcion'];


    public function Ventas(){
    	return $this->hasMany('App\Venta','ven_fk_fuenteventa','id');
    }
}
