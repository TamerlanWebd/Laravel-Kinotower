<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
    public function __invoke(Request $request, $filmId)
    {
        $film = Film::find($filmId);

        if (! $film) {
            return response()->json(['message' => 'Film not found'], 404);
        }

        $reviews = $film->reviews()
            ->where('is_approved', 1)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return [
            'reviews' => ReviewResource::collection($reviews),
        ];
    }
}
