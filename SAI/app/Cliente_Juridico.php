<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Juridico extends Model
{
    protected $table ="cliente_juridico";

    protected $fillable = [
    	'id','cli_jur_nombre','cli_jur_direccion',
    	'cli_jur_identificador','cli_jur_rif','cli_jur_fk_parroquia'
    ];
}
