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
            'name'   => 'required|string',
            'cep'    => 'required|string',
            'number' => 'required|string',
        ];
    }

    /**
     * Set the erro messages for the defied validation rules
     * @return array
     */
    public function messages()
    {
        return[
            'name.required'   => 'O campo name é obrigatório.',
            'cep.required'    => 'O campo cep é obrigatório.',
            'number.required' => 'O campo numer é obrigatório.'
        ];
    }
}
