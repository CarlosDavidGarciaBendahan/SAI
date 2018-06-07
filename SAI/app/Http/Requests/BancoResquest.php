<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadoResquest extends FormRequest
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
            'ban_nombre'          =>'Nombre del banco'
        ];
    }
    public function rules()
    {
        return [
            'ban_nombre'        => 'min:4|max:25|required|string|unique:banco'
        ];
    }
}
