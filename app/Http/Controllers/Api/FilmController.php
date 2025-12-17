<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Resources\FilmResource;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $query = Film::query();

        $page    = $request->input('page', 1);
        $size    = $request->input('size', 10);
        $sortBy  = $request->input('sortBy', 'name');
        $sortDir = $request->input('sortDir', 'asc');
        $sortDir = in_array(strtolower($sortDir), ['asc', 'desc']) ? $sortDir : 'asc';

        if ($sortBy === 'name') {
            $query->orderBy('name', $sortDir);
        } elseif ($sortBy === 'year') {
            $query->orderBy('year_of_issue', $sortDir);
        } elseif ($sortBy === 'rating') {
            $query
                ->withAvg('ratingAvg', 'ball')
                ->orderBy('rating_avg_ball', $sortDir);
        }

        if ($request->has('country')) {
            $query->where('country_id', $request->country);
        }

        if ($request->has('category')) {
            $query->withWhereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%');
        }

        $films = $query->paginate($size, ['*'], 'page', $page);

        return [
            'page'  => $films->currentPage(),
            'size'  => $films->perPage(),
            'total' => $films->total(),
            'films' => FilmResource::collection($films),

        ];

    }

    public function show($id)
    {
        $film = Film::find($id);
        if (!$film) {
            return response()->json(['message' => 'Film not found'], 404);
        }

        return response()->json(new FilmResource($film));
    }

}
