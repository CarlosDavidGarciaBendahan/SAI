<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_Computador extends Model
{
    protected $table ="producto_computador";

    protected $fillable = [
    	'id','pro_com_codigo','pro_com_descripcion',
    	'pro_com_cantidad','pro_com_precio','pro_com_moneda',
    	'pro_com_catalogo','pro_com_fk_sector','pro_com_fk_modelo',
    	'pro_com_fk_tipo_producto'
    ];
}
