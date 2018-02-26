<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table ="solicitud";

    protected $fillable = [
    	'id','sol_fecha','sol_tipo',
    	'sol_concepto','sol_fk_notaentrega'
    ];

    public function NotaEntrega(){
    	return $this->belongsTo('App\NotaEntrega','sol_fk_notaentrega','id');
    }

    public function CodigoPCs(){
        return $this->belongsToMany('App\CodigoPC','pc_solicitud','pc_sol_fk_solicitud','pc_sol_fk_codigopc');
    }

    public function CodigoArticulos(){
        return $this->belongsToMany('App\CodigoArticulo','articulo_solicitud','art_sol_fk_solicitud','art_sol_fk_codigopc');
    }
}
