<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProArtEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    public function attributes(){
        return [
            'pro_art_codigo'                => 'Código general del producto',
            'pro_art_descripcion'           => 'Descripción general del producto',
            'pro_art_precio'                => 'Precio del producto',
            'pro_art_moneda'                => 'Tipo de moneda',
            'pro_art_cantidad'              => 'Cantidad de producto en inventario',
            'pro_art_fk_tipo_producto'      => 'Código del tipo de producto',
            'pro_art_fk_modelo'             => 'Código del modelo de una marca',
            'pro_art_fk_sector'             => 'Código del sector de la oficina',
            'imagen'                        => 'Imagen del producto',
            'pro_art_capacidad'             => 'Capacidad del producto',
            'pro_art_fk_unidadmedida'       => 'Código de la unidad de medida'
        ];
    }
    public function rules()
    {
        return [
            'pro_art_codigo'                => 'min:3|max:200|required|string',
            'pro_art_descripcion'           => 'min:10|max:200|required|string',
            'pro_art_precio'                => 'digits_between:1,10|required|numeric',
            'pro_art_moneda'                => 'min:1|max:2|required|string',
            'pro_art_cantidad'              => 'digits_between:1,6|required|integer',
            'pro_art_fk_tipo_producto'      => 'required|integer',
            'pro_art_fk_modelo'             => 'required|integer',
            'pro_art_fk_sector'             => 'required|integer',
            'imagen'                        => 'mimes:jpg,jpeg,png',
            'pro_art_capacidad'             => 'digits_between:1,10|required|numeric',
            'pro_art_fk_unidadmedida'       => 'required|integer'
            
        ];
    }
}
