<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol_Permiso extends Model
{
    protected $table ="rol_permiso";

    protected $fillable = ['id','rol_per_fk_rol','rol_per_fk_permiso'];
}
