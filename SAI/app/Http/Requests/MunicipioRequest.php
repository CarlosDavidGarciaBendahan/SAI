<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MunicipioRequest extends FormRequest
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
            'mun_nombre'          =>'Nombre del municipio',
            'mun_fk_estado'       =>'Código del estado'
        ];
    }
    public function rules()
    {
        return [
            'mun_nombre'        => 'min:4|max:25|required|string',
            'mun_fk_estado'     => 'required|integer',
            
        ];
    }
}
