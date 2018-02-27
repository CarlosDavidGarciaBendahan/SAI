<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class RegistroPago extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'reg_fecha_pagado'
            ]
        ];
    }
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
