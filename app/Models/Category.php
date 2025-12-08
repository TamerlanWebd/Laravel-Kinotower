<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    public $timestamps = false;
    
    protected $fillable = ['name', 'parent_id'];
    
    // Отношение: категория может иметь родительскую категорию
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    
    // Отношение: категория может иметь дочерние категории
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    // Отношение: многие ко многим с фильмами
    public function films()
    {
        return $this->belongsToMany(Film::class, 'category_films');
    }
}
