<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table ="solicitud";

    protected $fillable = [
    	'id','sol_fecha','sol_tipo',
    	'sol_concepto','sol_fk_notaentrega'
    ];
}
