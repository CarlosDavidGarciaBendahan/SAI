<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Lote extends Model
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
                'source' => 'lot_nombre'
            ]
        ];
    }
    protected $table ="lote";

    protected $fillable = ['id','lot_nombre','lot_fecha_recibido'];


    public function CodigoPCs(){
    	return $this->hasMany('App\CodigoPC','cod_pc_fk_lote','id');
    }

    public function CodigoArticulos(){
    	return $this->hasMany('App\CodigoArticulo','cod_art_fk_lote','id');
    }
}
