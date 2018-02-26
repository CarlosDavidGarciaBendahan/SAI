<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table ="banco";

    protected $fillable = ['id','ban_nombre'];


    public function RegistroPagoOrigen(){
    	return $this->hasOne('App\RegistroPago','reg_fk_banco_origen','id');
    }

    public function RegistroPagoDestino(){
    	return $this->hasOne('App\RegistroPago','reg_fk_banco_destino','id');
    }
}
