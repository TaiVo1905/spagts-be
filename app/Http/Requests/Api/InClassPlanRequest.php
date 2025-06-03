<?php

namespace App\Http\Requests\Api;

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
            'lesson_learned' => ['sometimes'],
            'self_assessment' => ['sometimes', 'integer'],
            'difficulties' => ['sometimes'],
            'plan_to_improve' => ['sometimes'],
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
