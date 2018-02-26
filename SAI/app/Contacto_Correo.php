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


    public function Personal(){
    	return $this->belongsTo('App\Personal','con_cor_fk_personal','id');
    }

    public function Empresa(){
    	return $this->belongsTo('App\Empresa','con_cor_fk_empresa','id');
    }

    public function Cliente_Juridico(){
    	return $this->belongsTo('App\Cliente_Juridico','con_cor_fk_cliente_juridico','id');
    }

    public function Cliente_Natural(){
    	return $this->belongsTo('App\Cliente_Natural','con_cor_fk_cliente_natural','id');
    }
}
