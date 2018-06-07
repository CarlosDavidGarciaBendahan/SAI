<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoteRequest extends FormRequest
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
            'lot_nombre'          =>'Lote',
        ];
    }
    public function rules()
    {
        return [
            'lot_nombre'        => 'min:10|max:50|required|string|unique:lote'
        ];
    }
}
