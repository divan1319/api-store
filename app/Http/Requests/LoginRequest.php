<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required','exists:users,username'],
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            
            'username.required'=>'El email es obligatorio.',
            'username.exists' => 'No se encontro el username en el sistema, crea una cuenta en su lugar.',
            'password'=> 'La contrasena es obligatoria'
        ];
    }
}
