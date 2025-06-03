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
    if ($this->isMethod('post')) {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'goal_content' => 'required|string',
            'is_completed' => 'required|boolean',
            'student_id' => 'sometimes|numeric'
        ];
    }

    return [
        'start_date' => 'sometimes|date',
        'end_date' => 'sometimes|date',
        'goal_content' => 'sometimes|string',
        'student_id' => 'sometimes|numeric'
    ];
}

}