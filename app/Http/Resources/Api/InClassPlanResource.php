<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class InClassPlanResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'lesson_learned' => $this->lesson_learned,
            'self_assessment' => $this->self_assessment,
            'difficulties' => $this->difficulties,
            'plan_to_improve' => $this->plan_to_improve,
            'problem_solved' => $this->problem_solved,
            'module' => $this->module,
            'student' => $this->student,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
