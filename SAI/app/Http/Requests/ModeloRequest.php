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
            'mar_marca'          =>'Nombre de la marca'
        ];
    }
    public function rules()
    {
        return [
            'mar_marca'        => 'min:2|max:20|required|string|unique:marca'
        ];
    }
}
