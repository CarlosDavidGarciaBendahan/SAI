<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PC_Venta extends Model
{
    protected $table ="pc_venta";

    protected $fillable = [
    	'pc_ven_fk_codigopc','pc_ven_fk_venta','precio_unitario'
    ];



    public function Venta(){
    	return $this->belongsTo('App\Venta','pc_ven_fk_venta','id');
    }

    public function codigoPC(){
    	return $this->belongsTo('App\codigoPC','pc_ven_fk_codigopc','id');
    }
}
