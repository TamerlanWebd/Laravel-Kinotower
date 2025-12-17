<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
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
            'country' => $this->country ? [
                'id' => $this->country->id,
                'name' => $this->country->name,
            ] : null,
            'categories' => CategoryFilmResource::collection($this->whenLoaded('categories')),
            'ratingAvg' => round($this->ratings()->avg('ball'), 1),
            'reviewCount' => $this->reviews()->where('is_approved', 1)->count(),
        ];
    }
}
