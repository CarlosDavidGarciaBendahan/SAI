<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Tipo_Producto extends Model
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
                'source' => 'tip_tipo'
            ]
        ];
    }
    protected $table ="tipo_producto";

    protected $fillable = ['id','tip_tipo'];

    public function Producto_Computadores(){
    	return $this->hasMany('App\Producto_Computador','pro_com_fk_tipo_producto','id');
    }

    public function Producto_Articulos(){
    	return $this->hasMany('App\Producto_Articulo','pro_art_fk_tipo_producto','id');
    }
}
