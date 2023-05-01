<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'min:10', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRules::min(10)->letters()->symbols()->numbers()
            ],
            'username'=>['required','max:15','string','unique:users,username'],
            'rol'=>['required']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.min' => 'El nombre debe de tener al menos 10 caracteres',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El formato de correo no es valido',
            'email.unique' => 'Este correo ya esta registrado, inicia sesion',
            'password' => 'El password es obligatorio y debe contener al menos 10 caracteres entre ellos; un simbolo y un numero.',
            'password.confirmed' => 'Las contrasenas no coinciden',
            'username.required'=>'El username es obligatorio',
            'username.max'=>'El username tiene un maximo de 15 caracteres',
            'username.unique'=>'Este username ya esta registrado'
        ];
    }
}
