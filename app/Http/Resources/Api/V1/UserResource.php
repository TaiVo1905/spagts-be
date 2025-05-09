<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Clouds\CloudinaryService;

class UserResource extends JsonResource
{
    protected $cloudinaryService;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->cloudinaryService = app(CloudinaryService::class);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'imageUrl' => $this->image_key ? $this->cloudinaryService->getUrl($this->image_key) : null,
            'email' => $this->email,
            'roles' => $this->roles,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}