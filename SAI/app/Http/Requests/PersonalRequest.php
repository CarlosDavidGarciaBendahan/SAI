<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
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
            'per_identificador'     => 'Identificador',
            'per_cedula'            => 'cédula',
            'per_fecha_nacimiento'  => 'Fecha de nacimiento',
            'per_sueldo'            => 'Sueldo',
            'per_direccion'         => 'Dirección',
            'per_fk_rol'            => 'Rol',
            'per_fk_oficina'        => 'Oficina',
            'per_fk_parroquia'      => 'Código de parroquia',
            'correos'               =>'Correos',
            'codigos'               =>'Códigos de telefono',
            'numeros'               =>'Números telefonicos'
        ];
    }
    public function rules()
    {
        return [
            'per_nombre'            => 'required|string|min:3|max:25',
            'per_nombre2'           => 'string|min:3|max:25|nullable',
            'per_apellido'          => 'required|string|min:3|max:25',
            'per_apellido2'         => 'string|min:3|max:25|nullable',
            'per_identificador'     => 'required|string|max:1',
            'per_cedula'            => 'required|numeric|digits_between:1,9',
            'per_fecha_nacimiento'  => 'required|date',
            'per_sueldo'            => 'required|numeric',
            'per_direccion'         => 'required|string|min:10|max:250',
            'per_fk_rol'            => 'required|integer',
            'per_fk_oficina'        => 'required|integer',
            'per_fk_parroquia'      => 'required|integer',
            'correos'               => 'required',
            'codigos'               => 'required',
            'numeros'               => 'required'
        ];
    }
}
