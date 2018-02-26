<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    protected $table ="parroquia";

    protected $fillable = ['id','par_nombre','par_fk_municipio'];
}
