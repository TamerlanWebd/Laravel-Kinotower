<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'duration' => $this->duration,
            'year_of_issue' => $this->year_of_issue,
            'age' => $this->age,
            'link_img' => $this->link_img,
            'link_kinopoisk' => $this->link_kinopoisk,
            'link_video' => $this->link_video,
            'created_at' => $this->created_at,
            'country' => $this->country ? $this->country->name : null, 
            'categories' => CategoryFilmResource::collection($this->whenLoaded('categories')),
            'ratingAvg' => $this->ratings()->avg('ball'),
            'review' => $this->reviews()->count(),
        ];
    }
}