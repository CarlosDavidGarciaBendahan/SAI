<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Cliente_Natural extends Model
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
                'source' => 'cli_nat_nombre'
            ]
        ];
    }
    protected $table ="cliente_natural";

    protected $fillable = [
    	'id','cli_nat_direccion','cli_nat_nombre',
    	'cli_nat_nombre2','cli_nat_apellido','cli_nat_apellido2',
    	'cli_nat_identificador','cli_nat_cedula','cli_nat_fk_parroquia'
    ];

    public function Parroquia(){
    	return $this->belongsTo('App\Parroquia','cli_nat_fk_parroquia','id');
    }

    public function Contacto_Correos(){
    	return $this->hasMany('App\Contacto_Correo','con_cor_fk_cliente_natural','id');
    }

    public function Contacto_Telefonos(){
    	return $this->hasMany('App\Contacto_Telefono','con_tel_fk_cliente_natural','id');
    }

    public function Presupuestos(){
    	return $this->hasMany('App\Presupuesto','pre_fk_cliente_natural','id');
    }

    public function Ventas(){
    	return $this->hasMany('App\Venta','ven_fk_cliente_natural','id');
    }
}
