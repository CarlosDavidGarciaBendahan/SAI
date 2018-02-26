<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table ="venta";

    protected $fillable = [
    	'id','ven_fecha_compra','ven_monto_total',
    	'ven_moneda','ven_eliminada','ven_fk_cliente_natural',
    	'ven_fk_cliente_juridico'
    ];
}
