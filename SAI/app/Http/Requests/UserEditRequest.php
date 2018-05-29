<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserEditRequest extends FormRequest
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
            'name'          =>'Usuario',
            'activa'        =>'Estado',
            'fk_rol'        =>'Rol',
            'password'      =>'Clave'
        ];
    }
    public function rules()
    {
        if (Auth::user()->name === $this->name) {
            //verifico SI el usuario logeado es el igual al user->'name' que se quiere modificar
            return [
            'name'          =>'min:3|max:20|required|string|exists:users',
            'activa'        =>'nullable|integer',
            'fk_rol'        =>'nullable|integer',
            'password'      =>'min:8|required|string'
            ];
        }else{
            return [
            'name'          =>'min:3|max:20|required|string|exists:users',
            'activa'        =>'nullable|integer',
            'fk_rol'        =>'nullable|integer',
            'password'      =>'min:8|nullable|string'
            ];
        }
        
        
    }
}
