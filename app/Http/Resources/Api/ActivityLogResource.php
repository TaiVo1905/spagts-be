<?php
namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'action' => $this->action,
            'table_name' => $this->table_name,
            'record_id' => $this->record_id,
            'changes' => $this->changes,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
