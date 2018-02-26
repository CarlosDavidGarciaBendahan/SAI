<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table ="permiso";

    protected $fillable = ['id','perm_permiso'];
}
