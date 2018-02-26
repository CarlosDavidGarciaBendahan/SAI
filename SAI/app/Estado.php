<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = "estado";

    protected $fillable = ['id','est_nombre'];


    public function Municipios(){
    	return $this->hasMany('App\Municipio','mun_fk_estado','id');
    }
}
