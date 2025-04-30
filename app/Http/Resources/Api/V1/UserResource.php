<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Clouds\CloudinaryService;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'imageUrl' => $this->image_key ? CloudinaryService::getUrl($this->image_key) : null,
            'email' => $this->email,
            'roles' => $this->roles,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
