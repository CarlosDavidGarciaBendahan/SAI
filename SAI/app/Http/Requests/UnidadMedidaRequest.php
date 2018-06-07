<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadMedidaRequest extends FormRequest
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
            'uni_medida'          =>'Unidad de medida',
        ];
    }
    public function rules()
    {
        return [
            'uni_medida'        => 'min:1|max:10|required|string|unique:unidadmedida'
        ];
    }
}
