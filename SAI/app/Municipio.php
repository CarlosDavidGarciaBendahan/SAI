<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table ="municipio";

    protected $fillable = ['id','mun_nombre','mun_fk_estado'];
}
