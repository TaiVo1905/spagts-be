<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    public function authorize(): bool

    {
        return true;
    }


    public function rules()
    {
        $method = $this->method();

        $rules = [
            'name' => 'string|max:50',
            'teacher_id' => 'exists:users,id',
        ];

        if ($method === 'POST') {
            $rules['name'] = 'required|string|max:50';
            $rules['teacher_id'] = 'required|exists:users,id';
        } else {
            foreach ($rules as $key => $value) {
                $rules[$key] = 'sometimes|' . $value;
            }
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {

    }
}
