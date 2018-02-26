<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_Articulo extends Model
{
    protected $table ="producto_articulo";

    protected $fillable = [
    	'id','pro_art_codigo','pro_art_descripcion',
    	'pro_art_cantidad','pro_art_precio','pro_art_moneda',
    	'pro_art_catalogo','pro_art_capacidad','pro_art_fk_unidadmedida',
    	'pro_art_fk_sector','pro_art_fk_modelo','pro_art_fk_tipo_producto'
    ];
}
