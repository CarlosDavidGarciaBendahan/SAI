<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroPago extends Model
{
    protected $table ="registropago";

    protected $fillable = [
    	'id','reg_fecha_pagado','reg_monto',
    	'reg_moneda','reg_concepto','reg_forma',
    	'reg_numero_referencia','reg_fk_banco_origen','reg_fk_banco_destino',
    	'reg_fk_venta'
    ];

    public function Venta(){
    	return $this->belongsTo('App\Venta','reg_fk_venta','id');
    }

    public function BancoOrigen(){
    	return $this->belongsTo('App\Banco','reg_fk_banco_origen','id');
    }

    public function BancoDestino(){
    	return $this->belongsTo('App\Banco','reg_fk_banco_destino','id');
    }

}
