<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
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
                'source' => 'name'
            ]
        ];
    }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'activa', 'password',
        'fk_personal','fk_rol','id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function Personal(){
        return $this->belongsTo('App\Personal','fk_personal','id');
    }

    //relacion 1 a muchos. Asi guardo la fk del rol de usuario
    public function Rol(){
        return $this->belongsTo('App\Rol','fk_rol','id');
    }

    /*public function Roles(){
        return $this->belongsToMany('App\Rol','rol_user','rol_use_fk_user','rol_use_fk_rol');
    }*/
}
