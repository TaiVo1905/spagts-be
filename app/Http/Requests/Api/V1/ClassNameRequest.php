<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ClassNameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|max:50|unique:class_names,name',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'name' => 'required|string|max:50|unique:class_names,name,' . $this->route('class_name'),
            ];
        }

        return [];
    }
}
