<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table ="marca";

    protected $fillable = ['id','mar_marca'];

    public function Modelos(){
    	return $this->hasMany('App\Modelo','mod_fk_marca','id');
    }
}
