<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'activa', 'password',
        'fk_personal','id'
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

    public function Roles(){
        return $this->belongsToMany('App\Rol','rol_user','rol_use_fk_user','rol_use_fk_rol');
    }
}
