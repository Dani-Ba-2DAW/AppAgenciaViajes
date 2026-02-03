<?php

namespace App\Http\Requests;

class TypeEditRequest extends TypeCreateRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['name'] = 'required|string|min:3|max:100|unique:types,name,' . $this->route('type')->id;
        return $rules;
    }
}
