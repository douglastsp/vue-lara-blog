<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => $this->category->name,
            'title' => Str::limit($this->title, 15, '...'),
            'content' => Str::limit($this->content, 50, '...'),
            'thumbnail' => $this->thumbnail,
            'created_at' => $this->created_at->format('d/m/Y : H:i')
        ];
    }
}
