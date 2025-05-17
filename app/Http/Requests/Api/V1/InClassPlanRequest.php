<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class InClassPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'date' => ['sometimes', 'date'],
            'lesson_learned' => ['sometimes', 'string'],
            'self_assessment' => ['sometimes', 'integer'],
            'difficulties' => ['sometimes', 'string'],
            'plan_to_improve' => ['sometimes', 'string'],
            'problem_solved' => ['sometimes', 'boolean'],
            'module_id' => ['sometimes', 'exists:modules,id'],
            'student_id' => ['sometimes', 'exists:users,id'],
        ];

       if ($this->isMethod('post')) {
    $rules['module_id'] = ['required', 'exists:modules,id'];
    $rules['student_id'] = ['required', 'exists:users,id'];
}
        return $rules;
    }
    protected function prepareForValidation(): void
    {
    }
}
