<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Estado extends Model
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
                'source' => 'est_nombre'
            ]
        ];
    }
    protected $table = "estado";

    protected $fillable = ['id','est_nombre'];

   


    public function Municipios(){
    	return $this->hasMany('App\Municipio','mun_fk_estado','id');
    }
}
