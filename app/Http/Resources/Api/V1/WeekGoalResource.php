<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class WeekGoalResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'goal_content' => $this->goal_content,
            'is_completed' => $this->is_completed,
            'user_id' => $this->user_id,
        ];
    }
}
