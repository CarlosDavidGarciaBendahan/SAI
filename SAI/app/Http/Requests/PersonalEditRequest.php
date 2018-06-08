<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalEditRequest extends FormRequest
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
            'per_nombre'            => 'Primer nombre',
            'per_nombre2'           => 'Segundo nombre',
            'per_apellido'          => 'Primer apellido',
            'per_apellido2'         => 'Segundo apellido',
            'per_fecha_nacimiento'  => 'Fecha de nacimiento',
            'per_sueldo'            => 'Sueldo',
            'per_direccion'         => 'Dirección',
            'per_fk_rol'            => 'Rol',
            'per_fk_oficina'        => 'Oficina',
            'per_fk_parroquia'      => 'Código de parroquia'
        ];
    }
    public function rules()
    {
        return [
            'per_nombre'            => 'required|string|min:3|max:25',
            'per_nombre2'           => 'string|min:3|max:25|nullable',
            'per_apellido'          => 'required|string|min:3|max:25',
            'per_apellido2'         => 'string|min:3|max:25|nullable',
            'per_fecha_nacimiento'  => 'required|date',
            'per_sueldo'            => 'required|numeric',
            'per_direccion'         => 'required|string|min:10|max:250',
            'per_fk_rol'            => 'required|integer',
            'per_fk_oficina'        => 'required|integer',
            'per_fk_parroquia'      => 'required|integer',
        ];
    }
}
