<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SelfStudyPlanResources extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'lesson_learned' => $this->lesson_learned,
            'time_allocation' => $this->time_allocation,
            'learning_resources' => $this->learning_resources,
            'learning_activities' => $this->learning_activities,
            'concentration' => $this->concentration,
            'follow_plan_reflection' => $this->follow_plan_reflection,
            'evaluation' => $this->evaluation,
            'reinforcing_techniques' => $this->reinforcing_techniques,
            'note' => $this->note,
            'module' => $this->module,
            'student' => $this->student,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
