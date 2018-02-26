<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table ="empresa";

    protected $fillable = [
    	'id','emp_nombre','emp_direccion',
    	'emp_identificador','emp_rif','emp_fk_parroquia'
    ];


    public function Parroquia(){
    	return $this->belongsTo('App\Parroquia','emp_fk_parroquia','id');
    }

    public function Contacto_Correos(){
    	return $this->hasMany('App\Contacto_Correo','con_cor_fk_empresa','id');
    }

    public function Contacto_Telefonos(){
    	return $this->hasMany('App\Contacto_Telefono','con_tel_fk_empresa','id');
    }

    public function Presupuestos(){
        return $this->hasMany('App\Presupuesto','pre_fk_empresa','id');
    }

    public function NotaEntregas(){
        return $this->hasMany('App\NotaEntrega','not_fk_empresa','id');
    }

}
