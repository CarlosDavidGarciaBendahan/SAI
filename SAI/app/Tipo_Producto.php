<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Producto extends Model
{
    protected $table ="tipo_producto";

    protected $fillable = ['id','tip_tipo'];
}
