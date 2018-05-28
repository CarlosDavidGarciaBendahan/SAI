<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Rol extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'rol_rol'
            ]
        ];
    }
    protected $table ="rol";

    protected $fillable = ['id','rol_rol','rol_tipo'];


    public function Personal(){
    	return $this->hasMany('App\Personal','per_fk_rol','id');
    }
    public function Usuarios(){
        return $this->hasMany('App\Usuario','fk_rol','id');
    }

    /*public function Permisos(){
    	return $this->belongsToMany('App\Permiso','rol_permiso','rol_perm_fk_rol','rol_perm_fk_permiso');
    }

	public function Users(){
    	return $this->belongsToMany('App\User','rol_user','rol_use_fk_rol','rol_use_fk_user');
    }*/

}
