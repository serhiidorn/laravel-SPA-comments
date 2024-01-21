<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Comment */
class CommentResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'username' => $this->username,
            'email' => $this->email,
            'homepage' => $this->homepage,
            'published_at' => $this->created_at,
            'image' => $this->image,
            'file' => $this->file,
            'replies' => self::collection($this->replies),
        ];
    }
}
