<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Producto_Articulo extends Model
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
                'source' => 'pro_art_codigo'
            ]
        ];
    }
    protected $table ="producto_articulo";

    protected $fillable = [
    	'id','pro_art_codigo','pro_art_descripcion',
    	'pro_art_cantidad','pro_art_precio','pro_art_moneda',
    	'pro_art_catalogo','pro_art_capacidad','pro_art_fk_unidadmedida',
    	'pro_art_fk_sector','pro_art_fk_modelo','pro_art_fk_tipo_producto'
    ];


    public function Modelo(){
    	return $this->belongsTo('App\Modelo','pro_art_fk_modelo','id');
    }

    public function Tipo_Producto(){
        return $this->belongsTo('App\Tipo_Producto','pro_art_fk_tipo_producto','id');
    }

    public function UnidadMedida(){
        return $this->belongsTo('App\UnidadMedida','pro_art_fk_unidadmedida','');
    }

    public function Sector(){
        return $this->belongsTo('App\Sector','pro_art_fk_sector','id');
    }

    public function Imagenes(){
        return $this->hasMany('App\Imagen','ima_fk_producto_articulo','id');
    }

    public function CodigoArticulos(){
        return $this->hasMany('App\CodigoArticulo','cod_art_fk_producto_articulo','id');
    }

    public function Detalles(){
        return $this->hasMany('App\Detalle','det_fk_producto_articulo','id');
    }

    public function Computadores(){
        return $this->belongsToMany('App\Producto_Computador','computador_articulo','com_art_fk_producto_articulo','com_art_fk_producto_computador');
    }

    public function Historicos_Falta_Stock(){
        return $this->hasMany('App\Historico_Falta_Stock','fk_producto_articulo','id');
    }
}
