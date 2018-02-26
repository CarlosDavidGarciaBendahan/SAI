<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo_venta extends Model
{
    protected $table ="articulo_venta";

    protected $fillable = ['id','art_ven_fk_codigoarticulo','art_ven_fk_venta'];
}
