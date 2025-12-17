<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->when($this->user, function () {
                return [
                    'id'  => $this->user->id,
                    'fio' => $this->user->fio,
                ];
            }),
            'message' => $this->message,
            'created_at' => $this->created_at,
        ];
    }
}
