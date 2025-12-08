<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['film_id', 'user_id', 'ball'];
    
    // Отношение: оценка принадлежит одному фильму
    public function film()
    {
        return $this->belongsTo(Film::class);
    }
    
    // Отношение: оценка принадлежит одному пользователю
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
