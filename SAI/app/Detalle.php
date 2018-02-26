<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table ="detalle";

    protected $fillable = [
    	'id','det_cantidad','det_total',
    	'det_fk_presupuesto','det_fk_producto_computador','det_fk_producto_articulo'
    ];
}
