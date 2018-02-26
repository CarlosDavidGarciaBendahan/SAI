<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Natural extends Model
{
    protected $table ="cliente_natural";

    protected $fillable = [
    	'id','cli_nat_direccion','cli_nat_nombre',
    	'cli_nat_nombre2','cli_nat_apellido','cli_nat_apellido2',
    	'cli_nat_identificador','cli_nat_cedula','cli_nat_fk_parroquia'
    ];
}
