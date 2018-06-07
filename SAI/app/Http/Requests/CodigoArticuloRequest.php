<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodigoArticuloRequest extends FormRequest
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
            'cod_art_fk_producto_articulo'          =>'Código general del producto',
            'cod_art_fk_lote'                         =>'Código del lote',
            //'codigosPC'                         =>'Códigos de cada PC'
        ];
    }
    public function rules()
    {
        return [
            'cod_art_fk_producto_articulo'     =>'required|integer',
            'cod_art_fk_lote'                    =>'required|integer',
            //'codigosPC'                         =>'required'
        ];
    }
}
