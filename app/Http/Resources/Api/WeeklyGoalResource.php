<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class WeeklyGoalResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'goal_content' => $this->goal_content,
            'is_completed' => $this->is_completed,
            'student_id' => $this->student_id,
        ];
    }
}