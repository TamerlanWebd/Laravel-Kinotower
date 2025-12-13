<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewFilmController extends Controller
{
    public function index(Request $request)
    {
        $filmId = $request->integer('film_id');
        
        $query = Review::with(['film', 'user']);

        if ($filmId) {
            $query->where('film_id', $filmId);
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        $films = Film::orderBy('name')->get();

        return view('admin.reviews.index', compact('reviews', 'films', 'filmId'));
    }

    public function approve(string $id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => 1]);

        return redirect()->back()
            ->with('success', 'Отзыв успешно одобрен');
    }

    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()
            ->with('success', 'Отзыв успешно удален');
    }
}

