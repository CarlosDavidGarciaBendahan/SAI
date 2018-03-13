<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Personal extends Model
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
                'source' => 'per_nombre'
            ]
        ];
    }
    protected $table ="personal";

    protected $fillable = [
    	'id','per_nombre','per_nombre2',
    	'per_apellido','per_apellido2','per_identificador',
    	'per_cedula','per_fecha_nacimiento','per_sueldo',
    	'per_direccion','per_fk_parroquia','per_fk_rol',
    	'per_fk_oficina'
    ];

    public function Parroquia(){
    	return $this->belongsTo('App\Parroquia','per_fk_parroquia','id');
    }

    public function Contacto_Correos(){
        return $this->hasMany('App\Contacto_Correo','con_cor_fk_personal','id');
    }

    public function Contacto_Telefonos(){
        return $this->hasMany('App\Contacto_Telefono','con_tel_fk_personal','id');
    }

    public function User(){
        return $this->hasOne('App\User','fk_personal','id');
    }

    public function Oficina(){
        return $this->belongsTo('App\Oficina','per_fk_oficina','id');
    }

    public function Rol(){
        return $this->belongsTo('App\Rol','per_fk_rol','id');
    }
}
