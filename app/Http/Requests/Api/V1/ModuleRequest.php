<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['sometimes', 'required', 'string', 'max:50'],
            'teacher_id' => ['sometimes', 'required', 'exists:users,id'],
        ];

        if ($this->isMethod('post')) {
            $rules['name'] = ['required', 'string', 'max:50'];
            $rules['teacher_id'] = ['required', 'exists:users,id'];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        //
    }
}
