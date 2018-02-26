<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table ="lote";

    protected $fillable = ['id','lot_nombre','lot_fecha_recibido'];
}
