<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilmRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $query = Film::with(['country', 'categories']);

        if ($request->filled('country_id')) {
            $query->where('country_id', $request->integer('country_id'));
        }

        if ($request->filled('category_id')) {
            $categoryId = $request->integer('category_id');
            $query->whereHas('categories', fn ($q) => $q->where('categories.id', $categoryId));
        }

        $films = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $countries = Country::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.films.index', compact('films', 'countries', 'categories'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.films.create', compact('countries', 'categories'));
    }

    public function store(FilmRequest $request)
    {
        $data = $request->validated();
        $categories = $data['categories'] ?? [];
        unset($data['categories'], $data['poster']);

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $data['link_img'] = '/storage/' . $path;
        }

        $data['link_video'] = $data['link_video'] ?? '';

        $film = Film::create($data);
        $film->categories()->sync($categories);

        return redirect()->route('films.index');
    }

    public function edit(string $id)
    {
        $film = Film::with('categories')->findOrFail($id);
        $countries = Country::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.films.create', compact('film', 'countries', 'categories'));
    }

    public function update(FilmRequest $request, string $id)
    {
        $data = $request->validated();
        $categories = $data['categories'] ?? [];
        unset($data['categories'], $data['poster']);

        $film = Film::findOrFail($id);

        if ($request->hasFile('poster')) {
            if ($film->link_img) {
                $relativePath = str_replace('/storage/', '', $film->link_img);
                Storage::disk('public')->delete($relativePath);
            }
            $path = $request->file('poster')->store('posters', 'public');
            $data['link_img'] = '/storage/' . $path;
        }

        $data['link_video'] = $data['link_video'] ?? '';

        $film->update($data);
        $film->categories()->sync($categories);

        return redirect()->route('films.index');
    }

    public function destroy(string $id)
    {
        $film = Film::findOrFail($id);
        if ($film->link_img) {
            $relativePath = str_replace('/storage/', '', $film->link_img);
            Storage::disk('public')->delete($relativePath);
        }
        $film->categories()->detach();
        $film->delete();

        return redirect()->route('films.index');
    }
}

