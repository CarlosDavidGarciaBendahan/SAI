<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table ="modelo";

    protected $fillable = ['id','mod_modelo','mod_fk_marca'];
}
