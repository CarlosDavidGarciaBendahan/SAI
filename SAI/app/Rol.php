<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table ="rol";

    protected $fillable = ['id','rol_rol'];


    public function Personal(){
    	return $this->hasMany('App\Personal','per_fk_rol','id');
    }

    public function Permisos(){
    	return $this->belongsToMany('App\Permiso','rol_permiso','rol_per_rol','rol_per_permiso');
    }

	public function Users(){
    	return $this->belongsToMany('App\User','rol_user','rol_use_fk_rol','rol_use_fk_user');
    }

}
