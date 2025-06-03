<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'teacher_id' => 'required|numeric',
                'name' => 'required|string|max:50|unique:classes,name',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'teacher_id' => 'sometimes|numeric',
                'name' => 'sometimes|string|max:50|',
            ];
        }

        return [];
    }
}
