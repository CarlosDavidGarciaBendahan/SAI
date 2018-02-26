<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table ="presupuesto";

    protected $fillable = [
    	'id','pre_fecha_solicitud','pre_fecha_aprobado',
    	'pre_subtotal','pre_total','pre_eliminado',
    	'pre_fk_empresa','pre_fk_cliente_natural','pre_fk_cliente_juridico'
    ];
}
