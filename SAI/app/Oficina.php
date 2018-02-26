<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    protected $table ="oficina";

    protected $fillable = ['id','ofi_tipo','ofi_direccion','ofi_fk_parroquia'];

    public function Parroquia(){
    	return $this->belongsTo('App\Parroquia','ofi_fk_parroquia','id');
    }


    public function Personal(){
    	return $this->hasMany('App\Personal','per_fk_oficina','id');
    }

    public function Sectores(){
    	return $this->hasMany('App\Sector','sec_fk_oficina','id');
    }
}
