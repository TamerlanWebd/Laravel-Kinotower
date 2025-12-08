<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['name'];
    
    // Отношение: один пол может быть у многих пользователей
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
