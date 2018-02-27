<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Banco extends Model
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
                'source' => 'ban_nombre'
            ]
        ];
    }

    protected $table ="banco";

    protected $fillable = ['id','ban_nombre'];


    public function RegistroPagoOrigen(){
    	return $this->hasOne('App\RegistroPago','reg_fk_banco_origen','id');
    }

    public function RegistroPagoDestino(){
    	return $this->hasOne('App\RegistroPago','reg_fk_banco_destino','id');
    }
}
