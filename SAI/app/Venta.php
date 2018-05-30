<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Venta extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'ven_fecha_compra'
            ]
        ];
    }
    protected $table ="venta";

    protected $fillable = [
    	'id','ven_fecha_compra','ven_monto_total',
    	'ven_moneda','ven_eliminada','ven_fk_cliente_natural',
    	'ven_fk_cliente_juridico','ven_porcentaje_descuento'
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
        return $this->hasOne('App\NotaEntrega','not_fk_venta','id');
    }

    public function VentaPCs(){
        return $this->belongsToMany('App\CodigoPC','pc_venta','pc_ven_fk_venta','pc_ven_fk_codigopc');
    }

    public function VentaArticulos(){
        return $this->belongsToMany('App\CodigoArticulo','articulo_venta','art_ven_fk_venta','art_ven_fk_codigoarticulo');
    }

    public function FuenteVenta(){
        return $this->belongsTo('App\FuenteVenta','ven_fk_fuenteventa','id');
    }

}
