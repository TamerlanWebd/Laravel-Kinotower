<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'fio',
        'birthday',
        'gender_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date',
        ];
    }
    
    // Отношение: пользователь принадлежит одному полу
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    
    // Отношение: у пользователя может быть много отзывов
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    // Отношение: у пользователя может быть много оценок
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
