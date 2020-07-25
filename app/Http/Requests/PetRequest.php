<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'         => 'required|string',
            'description'  => 'required|string',
            'age'          => 'required|integer',
            'users_id'     => 'required|integer'
        ];
    }

    /**
     * Set the erro messages for the defied validation rules
     * @return array
     */
    public function messages()
    {
        return[
            'name.required'        => 'O campo name é obrigatório.',
            'description.required' => 'O campo description é obrigatório.',
            'age.required'         => 'O campo age é obrigatório.',
            'users_id.required'    => 'O campo users_id é obrigatório.'
        ];
    }    
}
