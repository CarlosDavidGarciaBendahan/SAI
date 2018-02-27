<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Municipio extends Model
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
                'source' => 'mun_nombre'
            ]
        ];
    }
    protected $table ="municipio";

    protected $fillable = ['id','mun_nombre','mun_fk_estado'];


    public function Estado(){
    	return $this->belongsTo('App\Estado','mun_fk_estado','id');
    }

    public function Parroquias(){
    	return $this->hasMany('App\Parroquia','par_fk_municipio','id');
    }
}
