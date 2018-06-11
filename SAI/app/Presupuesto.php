<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Presupuesto extends Model
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
                'source' => 'pre_fecha_solicitud'
            ]
        ];
    }
    protected $table ="presupuesto";

    protected $fillable = [
    	'id','pre_fecha_solicitud','pre_fecha_aprobado',
    	'pre_subtotal'/*,'pre_total'*/,'pre_eliminado',
    	'pre_fk_empresa','pre_fk_cliente_natural','pre_fk_cliente_juridico'
    ];

    public function Empresa(){
    	return $this->belongsTo('App\Empresa','pre_fk_empresa','id');
    }

    public function Cliente_Juridico(){
    	return $this->belongsTo('App\Cliente_Juridico','pre_fk_cliente_juridico','id');
    }

    public function Cliente_Natural(){
    	return $this->belongsTo('App\Cliente_Natural','pre_fk_cliente_natural','id');
    }

    public function Detalles(){
    	return $this->hasMany('App\Detalle','det_fk_presupuesto','id');
    }

    public function Historicos_Falta_Stock(){
        return $this->hasMany('App\Historico_Falta_Stock','fk_presupuesto','id');
    }

    public function Venta(){
        return $this->hasOne('App\Venta','ven_fk_presupuesto','id');
    }
}
