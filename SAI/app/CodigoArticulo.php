<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodigoArticulo extends Model
{
    protected $table ="codigoarticulo";

    protected $fillable = [
    	'id','cod_art_codigo','cod_art_estado',
    	'cod_art_fk_producto_articulo','cod_art_fk_lote',
    	'cod_art_fk_codigopc'
    ];
}
