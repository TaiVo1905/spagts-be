<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TimetableResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start' => $this->start,
            'end' => $this->end,
            'allDay' => $this->all_day,
            'color' => $this->color,
            'user_id' => $this->user_id,
            'module_id' => $this->module_id,
            'plan_id' => $this->plan_id,
            'type' => $this->type,
            'semester' => $this->semester,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}