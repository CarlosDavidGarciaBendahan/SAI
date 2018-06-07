<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectorRequest extends FormRequest
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
            'sec_nombre'          =>'Nombre del modelo',
            'sec_fk_oficina'        => 'Código de la oficina'
        ];
    }
    public function rules()
    {
        return [
            'sec_nombre'        => 'min:3|max:20|required|string',
            'sec_fk_oficina'      => 'integer|required'
        ];
    }
}
