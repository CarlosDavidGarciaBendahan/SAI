<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Producto_Computador extends Model
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
                'source' => 'pro_com_codigo'
            ]
        ];
    }
    protected $table ="producto_computador";

    protected $fillable = [
    	'id','pro_com_codigo','pro_com_descripcion',
    	'pro_com_cantidad','pro_com_precio','pro_com_moneda',
    	'pro_com_catalogo','pro_com_fk_sector','pro_com_fk_modelo',
    	'pro_com_fk_tipo_producto'
    ];


    public function Modelo(){
    	return $this->belongsTo('App\Modelo','pro_com_fk_modelo','id');
    }

    public function Tipo_Producto(){
        return $this->belongsTo('App\Tipo_Producto','pro_com_fk_tipo_producto','id');
    }

    public function Sector(){
        return $this->belongsTo('App\Sector','pro_com_fk_sector','id');
    }

    public function Imagenes(){
        return $this->hasMany('App\Imagen','ima_fk_producto_computador','id');
    }

    public function CodigoPCs(){
        return $this->hasMany('App\CodigoPC','cod_pc_fk_producto_computador','id');
    }

    public function Detalles(){
        return $this->hasMany('App\Detalle','det_fk_producto_computador','id');
    }

    public function Articulos(){
        return $this->belongsToMany('App\Producto_Articulo','computador_articulo','com_art_fk_producto_computador','com_art_fk_producto_articulo');
    }

}
