<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'commentable_type' => $this->commentable_type,
            'commentable_id'   => $this->commentable_id,
            'field_name'       => $this->field_name,
            'row'              => $this->row,
            'content'          => $this->content,

            'commenter'        => new UserResource($this->commenter),

            
            'replies'          => ReplyResource::collection($this->replies),

            'created_at'       => optional($this->created_at)->toISOString(),
            'updated_at'       => optional($this->updated_at)->toISOString(),
        ];
    }
}
