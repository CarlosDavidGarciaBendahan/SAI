<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto_Telefono extends Model
{
    protected $table ="contacto_telefono";

    protected $fillable = [
    	'id','con_tel_tipo','con_tel_codigo',
    	'con_tel_numero','con_tel_fk_empresa','con_tel_fk_personal',
    	'con_tel_fk_cliente_natural','con_tel_fk_cliente_juridico'
    ];

    public function Personal(){
    	return $this->belongsTo('App\Personal','con_tel_fk_personal','id');
    }

    public function Empresa(){
    	return $this->belongsTo('App\Empresa','con_tel_fk_empresa','id');
    }

    public function Cliente_Juridico(){
    	return $this->belongsTo('App\Cliente_Juridico','con_tel_fk_cliente_juridico','id');
    }

    public function Cliente_Natural(){
    	return $this->belongsTo('App\Cliente_Natural','con_tel_fk_cliente_natural','id');
    }
}
