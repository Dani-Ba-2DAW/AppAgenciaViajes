<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'user_id'     => 'usuario',
            'vacation_id' => 'vacación',
        ];
    }

    public function rules(): array
    {
        return [
            'user_id'     => 'required|exists:users,id',
            'vacation_id' => 'required|exists:vacations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'exists'   => 'El :attribute seleccionado no es válido.',
        ];
    }
}
