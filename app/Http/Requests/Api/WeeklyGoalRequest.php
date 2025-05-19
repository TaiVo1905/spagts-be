<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class WeeklyGoalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
{
    if ($this->isMethod('get')) {
        return [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'goal_content' => 'nullable|string',
        ];
    }

    return [
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'goal_content' => 'required|string',
        'student_id' => 'required|numeric'
    ];
}

}