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
}
