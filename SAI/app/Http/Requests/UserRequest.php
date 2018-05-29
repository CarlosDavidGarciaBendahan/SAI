<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //if ($this->user()->rol->rol_rol === 'Administrado') {
            
            return true; //activo el request para validar con el valor true
        /*} else {
            return false;
        }*/
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function attributes(){
        return [
            'name'          =>'Usuario',
            'activa'        =>'Estado',
            'fk_rol'        =>'Rol',
            'password'      =>'Clave'
        ];
    }
    public function rules()
    {
        return [
            'name'          =>'min:3|max:20|required|unique:users',
            'activa'        =>'required|integer',
            'fk_personal'   =>'required|integer',
            'fk_rol'        =>'required|integer',
            'password'      =>'nullable'
        ];
    }
}
