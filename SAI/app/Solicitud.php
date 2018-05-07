<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Solicitud extends Model
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
                'source' => 'sol_fecha'
            ]
        ];
    }
    protected $table ="solicitud";

    protected $fillable = [
    	'id','sol_fecha','sol_tipo',
    	'sol_concepto','sol_fk_notaentrega','sol_aprobado'
    ];

    public function NotaEntrega(){
    	return $this->belongsTo('App\NotaEntrega','sol_fk_notaentrega','id');
    }

    public function CodigoPCs(){
        return $this->belongsToMany('App\CodigoPC','pc_solicitud','pc_sol_fk_solicitud','pc_sol_fk_codigopc');
    }

    public function CodigoArticulos(){
        return $this->belongsToMany('App\CodigoArticulo','articulo_solicitud','art_sol_fk_solicitud','art_sol_fk_codigoarticulo');
    }

    public function CodigoPCsEntregado(){
        return $this->belongsToMany('App\CodigoPC','pc_solicitudentregado','pc_sol_fk_solicitud','pc_sol_fk_codigopc');
    }

    public function CodigoArticulosEntregado(){
        return $this->belongsToMany('App\CodigoArticulo','articulo_solicitudentregado','art_sol_fk_solicitud','art_sol_fk_codigoarticulo');
    }
}
