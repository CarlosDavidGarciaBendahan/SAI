<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuenteVentaRequest extends FormRequest
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
            'descripcion'          =>'Descripción de la fuente de venta',
            'nombre'                => 'Nombre de la fuente de venta'
        ];
    }
    public function rules()
    {
        return [
            'descripcion'        => 'min:4|max:50|required|string',
            'nombre'              => 'min:4|max:25|required|string|unique:fuenteventa'
        ];
    }
}
