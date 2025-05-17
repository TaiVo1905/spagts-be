<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class SelfStudyPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'date' => ['sometimes', 'nullable', 'date'],
            'lesson_learned' => ['sometimes', 'nullable', 'string'],
            'time_allocation' => ['sometimes', 'nullable', 'integer'],
            'learning_resources' => ['sometimes', 'nullable', 'string'],
            'learning_activities' => ['sometimes', 'nullable', 'string'],
            'concentration' => ['sometimes', 'nullable', 'integer'],
            'follow_plan_reflection' => ['sometimes', 'nullable', 'string'],
            'evaluation' => ['sometimes', 'nullable', 'string'],
            'reinforcing_techniques' => ['sometimes', 'nullable', 'string'],
            'note' => ['sometimes', 'nullable', 'string'],
            'module_id' => ['sometimes', 'nullable', 'exists:modules,id'],
            'student_id' => ['sometimes', 'nullable', 'exists:users,id'],
        ];

        if ($this->isMethod('post')) {
            $rules['module_id'] = ['required', 'exists:modules,id'];
            $rules['student_id'] = ['required', 'exists:users,id'];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        //
    }
}
