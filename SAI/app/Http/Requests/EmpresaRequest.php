<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
            'emp_fk_parroquia'  =>'Código de parroquia',
            'emp_direccion'     =>'Direción de la empresa',
            'emp_nombre'        =>'Nombre de la empresa',
            'emp_identificador' =>'Identificador',
            'emp_rif'           =>'RIF',
            'correos'           =>'Correos',
            'codigos'           =>'Códigos de telefono',
            'numeros'           =>'Números telefonicos'
        ];
    }
    public function rules()
    {
        return [
            'emp_fk_parroquia'  =>'required|integer',
            'emp_direccion'     =>'required|string|min:10|max:200',
            'emp_nombre'        =>'required|string|min:3|max:20',
            'emp_identificador' =>'required|string',
            'emp_rif'           =>'required|numeric|digits_between:1,10',
            'correos'           =>'required',
            'codigos'           =>'required',
            'numeros'           =>'required'
        ];
    }
}
