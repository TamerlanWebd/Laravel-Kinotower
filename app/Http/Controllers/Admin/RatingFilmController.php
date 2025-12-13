<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingFilmController extends Controller
{
    public function index(Request $request)
    {
        $filmId = $request->integer('film_id');
        
        $query = Rating::with(['film', 'user']);

        if ($filmId) {
            $query->where('film_id', $filmId);
        }

        $ratings = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $films = Film::orderBy('name')->get();

        return view('admin.ratings.index', compact('ratings', 'films', 'filmId'));
    }

    public function destroy(string $id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();

        return redirect()->back()
            ->with('success', 'Оценка успешно удалена');
    }
}

