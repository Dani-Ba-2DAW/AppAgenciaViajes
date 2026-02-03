<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'name' => 'nombre',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100|unique:types,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo :attribute es requerido.',
            'name.min'      => 'El campo :attribute debe tener al menos :min caracteres.',
            'name.max'      => 'El campo :attribute debe tener como máximo :max caracteres.',
            'name.string'   => 'El campo :attribute debe ser una cadena de caracteres.',
            'name.unique'   => 'El tipo ya existe.',
        ];
    }
}
