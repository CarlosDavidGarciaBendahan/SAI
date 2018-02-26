<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table ="permiso";

    protected $fillable = ['id','perm_permiso'];

    public function Roles(){
    	return $this->belongsToMany('App\Rol','rol_permiso','rol_per_fk_permiso','rol_per_fk_rol');
    }
}
