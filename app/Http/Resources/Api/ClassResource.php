<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Clouds\CloudinaryService;


class ClassResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "teacher" => (new UserResource($this->teacher)),
            'name' => $this->name,
        ];
    }
}
