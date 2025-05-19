<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class WeeklyGoalResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'goalContent' => $this->goal_content,
            'isCompleted' => $this->is_completed,
            'studentId' => $this->student_id,
        ];
    }
}