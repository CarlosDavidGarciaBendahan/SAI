<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table ="personal";

    protected $fillable = [
    	'id','per_nombre','per_nombre2',
    	'per_apellido','per_apellido2','per_identificador',
    	'per_cedula','per_fecha_nacimiento','per_sueldo',
    	'per_direccion','per_fk_parroquia','per_fk_rol',
    	'per_fk_oficina'
    ];
}
