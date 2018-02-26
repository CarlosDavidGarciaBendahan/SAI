<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodigoPC extends Model
{
    protected $table ="codigopc";

    protected $fillable = [
    	'id','cod_pc_codigo','cod_pc_estado',
    	'cod_pc_fk_producto_computador','cod_pc_fk_lote'
    ];
}
