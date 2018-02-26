<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo_Solicitud extends Model
{
    protected $table ="articulo_solicitud";

    protected $fillable = ['id','art_sol_fk_codigoarticulo','art_sol_fk_solicitud'];
}
