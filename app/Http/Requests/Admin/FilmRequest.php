<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
            'duration' => 'required|integer|min:1',
            'year_of_issue' => 'required|integer|min:1888|max:' . (date('Y') + 1),
            'age' => 'required|integer|min:0|max:120',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link_kinopoisk' => 'nullable|url|max:255',
            'link_video' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ];
    }
}

