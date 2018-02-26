<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PC_venta extends Model
{
    protected $table ="pc_venta";

    protected $fillable = ['id','pc_venta_fk_codigopc','pc_venta_fk_venta'];
}
