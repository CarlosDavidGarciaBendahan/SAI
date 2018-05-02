<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CodigoPC extends Model
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
                'source' => 'cod_pc_codigo'
            ]
        ];
    }
    protected $table ="codigopc";

    protected $fillable = [
    	'id','cod_pc_codigo','cod_pc_estado',
    	'cod_pc_fk_producto_computador','cod_pc_fk_lote'
    ];


    public function Producto_Computador(){
    	return $this->belongsTo('App\Producto_Computador','cod_pc_fk_producto_computador','id');
    }

    public function CodigoArticulos(){
    	return $this->hasMany('App\CodigoArticulo','cod_art_fk_pc','id');
    }

    public function Lote(){
    	return $this->belongsTo('App\Lote','cod_pc_fk_lote','id');
    }

    public function Solicitudes(){
        return $this->belongsToMany('App\Solicitud','pc_solicitud','pc_sol_fk_codigopc','pc_sol_fk_solicitud');
    }
    public function SolicitudesEntregadas(){
        return $this->belongsToMany('App\Solicitud','pc_solicitudEntregado','pc_sol_fk_codigopc','pc_sol_fk_solicitud');
    }

    public function Ventas(){
        return $this->belongsToMany('App\Venta','pc_venta','pc_ven_fk_codigopc','pc_ven_fk_venta');
    }

}
