<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto_Correo extends Model
{
    protected $table ="contacto_correo";

    protected $fillable = [
    	'id','con_cor_correo','con_cor_fk_empresa',
    	'con_cor_fk_personal','con_cor_fk_cliente_natural','con_cor_fk_cliente_juridico'
    ];
}
