<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'country_id', 'duration', 'year_of_issue', 
        'age', 'link_img', 'link_kinopoisk', 'link_video'
    ];
    
    // Отношение: фильм принадлежит одной стране
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    
    // Отношение: многие ко многим с категориями
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_films');
    }
    
    // Отношение: у фильма может быть много отзывов
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    // Отношение: у фильма может быть много оценок
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
