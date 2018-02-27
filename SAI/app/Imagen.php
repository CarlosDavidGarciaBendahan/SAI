<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Imagen extends Model
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
                'source' => 'ima_nombre'
            ]
        ];
    }
    protected $table="imagen";

    protected $fillable = [
    	'id','ima_fk_producto_computador','ima_fk_producto_articulo'
    ];


    public function Producto_Computador(){
    	return $this->belongsTo('App\Producto_Computador','ima_fk_producto_computador','id');
    }

    public function Producto_Articulo(){
    	return $this->belongsTo('App\Producto_Articulo','ima_fk_producto_articulo','id');
    }
}
