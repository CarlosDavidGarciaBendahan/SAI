<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class NotaEntrega extends Model
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
                'source' => 'not_fecha'
            ]
        ];
    }
    protected $table ="notaentrega";

    protected $fillable = [
    	'id','not_fecha','not_subtotal',
    	'not_observaciones','not_fk_empresa','not_fk_venta'
    ];


    public function Venta(){
    	return $this->belongsTo('App\Venta','not_fk_venta','id');
    }

    public function Empresa(){
    	return $this->belongsTo('App\Empresa','not_fk_empresa','id');
    }

    public function Solicitudes(){
    	return $this->hasMany('App\Solicitud','sol_fk_notaentrega','id');
    }
}
