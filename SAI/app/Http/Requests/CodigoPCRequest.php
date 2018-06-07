<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodigoPCRequest extends FormRequest
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
            'cod_pc_fk_producto_computador'          =>'Código general del producto',
            'cod_pc_fk_lote'                         =>'Código del lote',
            //'codigosPC'                         =>'Códigos de cada PC'
        ];
    }
    public function rules()
    {
        return [
            'cod_pc_fk_producto_computador'     =>'required|integer',
            'cod_pc_fk_lote'                    =>'required|integer',
            //'codigosPC'                         =>'required'
        ];
    }
}
