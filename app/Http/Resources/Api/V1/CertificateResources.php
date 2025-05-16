<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Clouds\CloudinaryService;


class CertificateResources extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'imageUrl' => $this->image_key,
            'module' => $this->module,
            'date' =>$this->date,
            'description' => $this->description
        ];
    }
}
