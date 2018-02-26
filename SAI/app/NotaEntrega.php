<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaEntrega extends Model
{
    protected $table ="notaentrega";

    protected $fillable = [
    	'id','not_fecha','not_subtotal',
    	'not_observaciones','not_fk_empresa','not_fk_venta'
    ];


    public function Venta(){
    	return $this->belongsTo('App\Venta','not_fk_venta','id');
    }

    public function Empresa(){
    	return $this->belongsTo('App\Empresa','not_fk_empresa','id');
    }

    public function Solicitudes(){
    	return $this->hasMany('App\Solicitud','sol_fk_notaentrega','id');
    }
}
