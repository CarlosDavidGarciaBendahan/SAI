<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OficinaRequest extends FormRequest
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
            'ofi_fk_parroquia'      =>'Código de parroquia',
            'ofi_tipo'              =>'Tipo de oficina (local, almacen)',
            'ofi_direccion'         =>'Dirección de la empresa'

        ];
    }
    public function rules()
    {
        return [
            'ofi_fk_parroquia'      =>'required|integer',
            'ofi_tipo'              =>'required|string',
            'ofi_direccion'         =>'required|string|min:10|max:250'
        ];
    }
}
