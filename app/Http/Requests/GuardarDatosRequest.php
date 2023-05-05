<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarDatosRequest extends FormRequest
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
            'user_id'=>'required',
            'dui'=>['required','max:10','unique:profiles,dui'],
            'telefono'=>['required','max:9','unique:profiles,telefono'],
            'municipio_id'=>'required',
            'ocupation_id'=>'required',
            'descripcion'=>['required','min:30'],
            'imagen'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'dui.required'=>'El DUI es obligatorio',
            'dui.unique'=>'Al parecer este DUI ya ha sido registrado',
            'telefono.required'=>'El numero telefonico es obligatorio',
            'telefono.unique'=>'Al parecer este numero ya ha sido registrado',
            'descripcion.required'=>'La descripcion es obligatoria',
            'descripcion.min'=>'La descripcion debe de tener por lo menos 30 caracteres',
            'imagen'=>'La imagen es obligatoria'
        ];
    }
}
