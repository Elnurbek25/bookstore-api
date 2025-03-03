<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'author' => new AuthorResource($this->whenLoaded('author')),
        ];
    }
}
