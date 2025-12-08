<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['film_id', 'user_id', 'message', 'is_approved'];
    
    // Отношение: отзыв принадлежит одному фильму
    public function film()
    {
        return $this->belongsTo(Film::class);
    }
    
    // Отношение: отзыв принадлежит одному пользователю
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
