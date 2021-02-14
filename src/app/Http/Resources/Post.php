<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'external_id' => $this->external_id,
            'publication_date' => !empty($this->publication_date) ? $this->publication_date->toDateTimeString() : null,
            'parsed_at' => !empty($this->parsed_at) ? $this->parsed_at->toDateTimeString() : null,
            'created_at' => !empty($this->created_at) ? $this->created_at->toDateTimeString() : null,
            'tags' => Tag::collection($this->whenLoaded('tags'))
        ];
    }
}
