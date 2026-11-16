<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
public function toArray($request): array
{
    return [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'status' => $this->status,
        'due_date' => $this->due_date,
        'project' => new ProjectResource($this->whenLoaded('project')),
        'comments' => CommentResource::collection($this->whenLoaded('comments')),
        'created_at' => $this->created_at?->toDateTimeString(),
    ];
}
}
