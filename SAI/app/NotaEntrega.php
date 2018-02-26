<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaEntrega extends Model
{
    protected $table ="notaentrega";

    protected $fillable = [
    	'id','not_fecha','not_subtotal',
    	'not_observaciones','not_fk_empresa','not_fk_venta'
    ];
}
