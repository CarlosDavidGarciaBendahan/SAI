<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModeloRequest extends FormRequest
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
            'mod_modelo'          =>'Nombre del modelo',
            'mod_fk_marca'        => 'Código de la marca'
        ];
    }
    public function rules()
    {
        return [
            'mod_modelo'        => 'min:3|max:20|required|string',
            'mod_fk_marca'      => 'integer|required'
        ];
    }
}
