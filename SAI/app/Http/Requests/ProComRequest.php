<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProComRequest extends FormRequest
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
            'pro_com_codigo'                => 'Código general del producto',
            'pro_com_descripcion'           => 'Descripción general del producto',
            'pro_com_precio'                => 'Precio del producto',
            'pro_com_moneda'                => 'Tipo de moneda',
            'pro_com_cantidad'              => 'Cantidad de producto en inventario',
            'pro_com_fk_tipo_producto'      => 'Código del tipo de producto',
            'pro_com_fk_modelo'             => 'Código del modelo de una marca',
            'pro_com_fk_sector'             => 'Código del sector de la oficina',
            //'componentes[]'                 => 'componentes que conforman la PC',
            'imagen'                        => 'Imagen del producto'
        ];
    }
    public function rules()
    {
        return [
            'pro_com_codigo'                => 'min:3|max:200|required|string|unique:producto_computador',
            'pro_com_descripcion'           => 'min:10|max:200|required|string',
            'pro_com_precio'                => 'digits_between:1,10|required|numeric',
            'pro_com_moneda'                => 'min:1|max:2|required|string',
            'pro_com_cantidad'              => 'digits_between:1,6|required|integer',
            'pro_com_fk_tipo_producto'      => 'required|integer',
            'pro_com_fk_modelo'             => 'required|integer',
            'pro_com_fk_sector'             => 'required|integer',
            'componentes'                   => 'required',
            'imagen'                        => 'required|mimes:jpg,jpeg,png'
            
        ];
    }
}
