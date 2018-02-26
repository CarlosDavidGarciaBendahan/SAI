<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PC_Solicitud extends Model
{
    protected $table ="pc_solicitud";

    protected $fillable = ['id','pc_sol_fk_codigopc','pc_sol_fk_solicitud'];
}
