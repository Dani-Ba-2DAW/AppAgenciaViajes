<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'image' => 'imagen',
        ];
    }

    public function rules(): array
    {
        return [
            'vacation_id' => 'required|exists:vacations,id',
            'image'       => 'required|array|min:1',
            'image.*'     => 'image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required'   => 'Debes subir al menos una imagen.',
            'image.array'      => 'Formato de imágenes no válido.',
            'image.*.image'    => 'Todos los archivos deben ser imágenes.',
            'image.*.max'      => 'Las imágenes no pueden superar los 2MB.',
        ];
    }
}
