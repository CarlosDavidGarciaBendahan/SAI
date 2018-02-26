<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table ="empresa";

    protected $fillable = [
    	'id','emp_nombre','emp_direccion',
    	'emp_identificador','emp_rif','emp_fk_parroquia'
    ];
}
