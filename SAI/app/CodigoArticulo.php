<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CodigoArticulo extends Model
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
                'source' => 'cod_art_codigo'
            ]
        ];
    }
    protected $table ="codigoarticulo";

    protected $fillable = [
    	'id','cod_art_codigo','cod_art_estado',
    	'cod_art_fk_producto_articulo','cod_art_fk_lote',
    	'cod_art_fk_codigopc'
    ];

    public function Producto_Articulo(){
    	return $this->belongsTo('App\Producto_Articulo','cod_art_fk_producto_articulo','id');
    }

    public function CodigoPC(){
    	return $this->belongsTo('App\CodigoPC','cod_art_fk_pc','id');
    }

    public function Lote(){
    	return $this->belongsTo('App\Lote','cod_art_fk_lote','id');
    }

    public function Solicitudes(){
        return $this->belongsToMany('App\Solicitud','articulo_solicitud','art_sol_fk_codigoarticulo','art_sol_fk_solicitud');
    }
    public function SolicitudesEntregadas(){
        return $this->belongsToMany('App\Solicitud','articulo_solicitudEntregado','art_sol_fk_codigoarticulo','art_sol_fk_solicitud');
    }


    public function Ventas(){
        return $this->belongsToMany('App\Venta','articulo_venta','art_ven_fk_codigoarticulo','art_ven_fk_venta');
    }
}
