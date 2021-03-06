<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Sector extends Model
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
                'source' => 'sec_sector'
            ]
        ];
    }
    protected $table ="sector";

    protected $fillable = ['id','sec_sector','sec_fk_oficina'];

    public function Oficina(){
    	return $this->belongsTo('App\Oficina','sec_fk_oficina','id');
    }

    public function Producto_Computadores(){
    	return $this->hasMany('App\Producto_Computador','pro_com_fk_tipo_producto','id');
    }

    public function Producto_Articulos(){
    	return $this->hasMany('App\Producto_Articulo','pro_art_fk_tipo_producto','id');
    }
}
