<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'text'        => 'comentario',
            'user_id'     => 'usuario',
            'vacation_id' => 'vacación',
        ];
    }

    public function rules(): array
    {
        return [
            'text'        => 'required|string|min:3|max:500',
            'user_id'     => 'required|exists:users,id',
            'vacation_id' => 'required|exists:vacations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'min'      => 'El campo :attribute debe tener al menos :min caracteres.',
            'max'      => 'El campo :attribute debe tener como máximo :max caracteres.',
            'exists'   => 'El :attribute seleccionado no es válido.',
        ];
    }
}
