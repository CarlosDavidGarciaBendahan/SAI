<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Juridico extends Model
{
    protected $table ="cliente_juridico";

    protected $fillable = [
    	'id','cli_jur_nombre','cli_jur_direccion',
    	'cli_jur_identificador','cli_jur_rif','cli_jur_fk_parroquia'
    ];


    public function Parroquia(){
    	return $this->belongsTo('App\Parroquia','cli_jur_fk_parroquia','id');
    }

    public function Contacto_Correos(){
    	return $this->hasMany('App\Contacto_Correo','con_cor_fk_cliente_juridico','id');
    }

    public function Contacto_Telefonos(){
    	return $this->hasMany('App\Contacto_Telefono','con_tel_fk_cliente_juridico','id');
    }

    public function Presupuestos(){
    	return $this->hasMany('App\Presupuesto','pre_fk_cliente_juridico','id');
    }

    public function Ventas(){
    	return $this->hasMany('App\Venta','ven_fk_cliente_juridico','id');
    }
}
