<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $films = Film::all();
        $users = User::all();

        if ($films->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Сначала нужно запустить FilmSeeder и UserSeeder!');
            return;
        }

        // Создаем оценки для популярных фильмов
        $popularFilms = [
            'Побег из Шоушенка' => [10, 9, 10, 9, 10, 8, 9],
            'Крестный отец' => [10, 10, 9, 10, 9, 8, 10],
            'Темный рыцарь' => [10, 9, 10, 9, 8, 10, 9],
            'Список Шиндлера' => [10, 10, 9, 10, 9, 10],
            'Властелин колец: Возвращение короля' => [10, 9, 10, 9, 10, 8],
            'Криминальное чтиво' => [9, 10, 9, 8, 10, 9],
            'Форрест Гамп' => [9, 10, 9, 10, 8, 9],
            'Бойцовский клуб' => [9, 8, 10, 9, 8, 9],
            'Начало' => [9, 10, 9, 8, 10, 9],
            'Матрица' => [10, 9, 8, 10, 9, 8],
            'Интерстеллар' => [10, 9, 10, 9, 8, 10],
            'Паразиты' => [9, 10, 9, 8, 9, 10],
            'Унесённые призраками' => [10, 9, 10, 9, 8, 9],
            'Зеленая миля' => [10, 9, 10, 9, 8, 10],
            'Пианист' => [9, 10, 9, 8, 9, 10],
        ];

        $userIndex = 0;
        foreach ($popularFilms as $filmName => $ratings) {
            $film = $films->firstWhere('name', $filmName);
            
            if (!$film) {
                continue;
            }

            foreach ($ratings as $ball) {
                if ($userIndex >= $users->count()) {
                    $userIndex = 0;
                }
                
                $user = $users[$userIndex];
                
                // Проверяем, не оценил ли уже этот пользователь этот фильм
                $existingRating = Rating::where('film_id', $film->id)
                    ->where('user_id', $user->id)
                    ->first();
                
                if (!$existingRating) {
                    Rating::create([
                        'film_id' => $film->id,
                        'user_id' => $user->id,
                        'ball' => $ball,
                    ]);
                }
                
                $userIndex++;
            }
        }

        // Добавляем случайные оценки для остальных фильмов
        $remainingFilms = $films->whereNotIn('name', array_keys($popularFilms));
        
        foreach ($remainingFilms as $film) {
            // Каждый фильм получает от 3 до 8 случайных оценок
            $numRatings = rand(3, 8);
            $selectedUsers = $users->random(min($numRatings, $users->count()));
            
            foreach ($selectedUsers as $user) {
                // Проверяем, не оценил ли уже этот пользователь этот фильм
                $existingRating = Rating::where('film_id', $film->id)
                    ->where('user_id', $user->id)
                    ->first();
                
                if (!$existingRating) {
                    Rating::create([
                        'film_id' => $film->id,
                        'user_id' => $user->id,
                        'ball' => rand(5, 10), // Оценки от 5 до 10
                    ]);
                }
            }
        }

        // Добавляем еще несколько случайных оценок от разных пользователей
        for ($i = 0; $i < 20; $i++) {
            $film = $films->random();
            $user = $users->random();
            
            // Проверяем, не оценил ли уже этот пользователь этот фильм
            $existingRating = Rating::where('film_id', $film->id)
                ->where('user_id', $user->id)
                ->first();
            
            if (!$existingRating) {
                Rating::create([
                    'film_id' => $film->id,
                    'user_id' => $user->id,
                    'ball' => rand(6, 10),
                ]);
            }
        }
    }
}

