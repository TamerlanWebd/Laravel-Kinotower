<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Film;
use Illuminate\Http\Request;

class CategoryFilmController extends Controller
{
    public function index(Request $request, $filmId)
    {
        $film = Film::with('categories')->findOrFail($filmId);
        $allCategories = Category::orderBy('name')->get();
        
        return view('admin.films.categories.index', compact('film', 'allCategories'));
    }

    public function store(Request $request, $filmId)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $film = Film::findOrFail($filmId);
        $categoryId = $request->integer('category_id');

        if (!$film->categories()->where('categories.id', $categoryId)->exists()) {
            $film->categories()->attach($categoryId);
        }

        return redirect()->route('films.categories.index', $filmId)
            ->with('success', 'Жанр успешно добавлен к фильму');
    }

    public function destroy($filmId, $categoryId)
    {
        $film = Film::findOrFail($filmId);
        $film->categories()->detach($categoryId);

        return redirect()->route('films.categories.index', $filmId)
            ->with('success', 'Жанр успешно удален у фильма');
    }
}

