<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Боевик', 'Комедия', 'Драма', 'Фантастика', 
            'Триллер', 'Ужасы', 'Мелодрама', 'Детектив',
            'Приключения', 'Фэнтези', 'Военный', 'Биография',
            'Документальный', 'Мультфильм', 'Криминал', 'История'
        ];
        
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'parent_id' => null
            ]);
        }
    }
}
