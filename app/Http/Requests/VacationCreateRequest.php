<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacationCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'title'       => 'título',
            'description' => 'descripción',
            'price'       => 'precio',
            'country'     => 'país',
            'type_id'     => 'tipo',
        ];
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|min:3|max:150',
            'description' => 'required|string|max:2000',
            'price'       => 'required|numeric|min:0',
            'country'     => 'required|string|max:100',
            'type_id'     => 'required|exists:types,id',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'string'   => 'El campo :attribute debe ser texto.',
            'min'      => 'El campo :attribute debe mayor o igual a :min.',
            'max'      => 'El campo :attribute debe tener como máximo :max caracteres.',
            'numeric'  => 'El campo :attribute debe ser numérico.',
            'exists'   => 'El :attribute seleccionado no es válido.',
        ];
    }
}
