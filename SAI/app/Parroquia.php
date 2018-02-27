<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Parroquia extends Model
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
                'source' => 'par_nombre'
            ]
        ];
    }
    protected $table ="parroquia";

    protected $fillable = ['id','par_nombre','par_fk_municipio'];

   
    public function Municipio(){
    	return $this->belongsTo('App\Municipio','par_fk_municipio','id');
    }

    public function Empresas(){
    	return $this->hasMany('App\Empresa','emp_fk_parroquia','id');
    }

    public function Clientes_Naturales(){
    	return $this->hasMany('App\Cliente_Natural','cli_nat_fk_parroquia','id');
    }

    public function Clientes_Juridicos(){
    	return $this->hasMany('App\Cliente_Juridico','cli_jur_fk_parroquia','id');
    }

    public function Oficinas(){
    	return $this->hasMany('App\Oficina','ofi_fk_parroquia','id');
    }

    public function Personal(){
    	return $this->hasMany('App\Personal','per_fk_parroquia','id');
    }
}
