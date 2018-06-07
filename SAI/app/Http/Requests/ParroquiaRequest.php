<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParroquiaRequest extends FormRequest
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
            'par_nombre'          =>'Nombre de la parroquia',
            'par_fk_municipio'       =>'Código del municipio'
        ];
    }
    public function rules()
    {
        return [
            'par_nombre'        => 'min:4|max:25|required|string',
            'par_fk_municipio'     => 'required|integer',
            
        ];
    }
}
