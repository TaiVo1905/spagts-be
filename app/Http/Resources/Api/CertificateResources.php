<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Clouds\CloudinaryService;


class CertificateResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        $cloudinaryService = app(CloudinaryService::class);
        return [
            'id' => $this->id,
            'imageUrl' => $this->image_key ? $cloudinaryService->getUrl($this->image_key) : null,
            'module' => $this->module,
            'semester' => $this->semester,
            'date' => $this->date,
            'description' => $this->description
        ];
    }
}
