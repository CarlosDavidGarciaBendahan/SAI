<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table ="venta";

    protected $fillable = [
    	'id','ven_fecha_compra','ven_monto_total',
    	'ven_moneda','ven_eliminada','ven_fk_cliente_natural',
    	'ven_fk_cliente_juridico'
    ];


    public function Cliente_Juridico(){
    	return $this->belongsTo('App\Cliente_Juridico','ven_fk_cliente_juridico','id');
    }

    public function Cliente_Natural(){
    	return $this->belongsTo('App\Cliente_Natural','ven_fk_cliente_natural','id');
    }

    public function RegistroPagos(){
    	return $this->hasMany('App\RegistroPago','reg_fk_venta','id');
    }

    public function NotaEntrega(){
        return $this->hasOne('App\NotaEntrega','reg_fk_notaentrega','id');
    }

    public function VentaPCs(){
        return $this->('App\CodigoPC','pc_venta','pc_sol_fk_venta','pc_sol_fk_codigopc');
    }

    public function VentaArticulos(){
        return $this->belongsToMany('App\CodigoArticulo','articulo_venta','art_ven_fk_venta','art_ven_fk_codigoarticulo');
    }

}
