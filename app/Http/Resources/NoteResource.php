<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'created_at'    => $this->created_at,
            'expired_at'    => $this->expired_at,
            'image'         => $this->image,
            'user'          => new UserResource($this->whenLoaded('user')),
            'categories'    => CategoryResource::collection($this->whenLoaded('categories'))

        ];
        
    }
}
