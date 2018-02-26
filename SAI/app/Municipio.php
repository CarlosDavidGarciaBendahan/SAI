<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table ="municipio";

    protected $fillable = ['id','mun_nombre','mun_fk_estado'];


    public function Estado(){
    	return $this->belongsTo('App\Estado','mun_fk_estado','id');
    }

    public function Parroquias(){
    	return $this->hasMany('App\Parroquia','par_fk_municipio','id');
    }
}
