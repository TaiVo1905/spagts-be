<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Clouds\CloudinaryService;


class ModuleResource extends JsonResource
{
    public function toArray(Request $request): array

    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'teacher_id' => $this->teacher_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
