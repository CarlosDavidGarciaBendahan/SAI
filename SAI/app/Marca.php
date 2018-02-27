<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Marca extends Model
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
                'source' => 'mar_marca'
            ]
        ];
    }
    protected $table ="marca";

    protected $fillable = ['id','mar_marca'];

    public function Modelos(){
    	return $this->hasMany('App\Modelo','mod_fk_marca','id');
    }
}
