<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cambio_bolivar extends Model
{
    protected $table ="cambio_bolivar";

    protected $fillable = [
    	'precio_dolar','fecha'
    ];
}
