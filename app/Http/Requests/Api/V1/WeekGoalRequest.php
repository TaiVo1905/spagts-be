<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class WeekGoalRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Nếu có sử dụng auth thì kiểm tra ở đây, tạm thời để true
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
    ];
}

}