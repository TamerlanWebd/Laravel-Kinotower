<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $films = Film::all();
        $users = User::all();

        if ($films->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Сначала нужно запустить FilmSeeder и UserSeeder!');
            return;
        }

        $reviews = [
            [
                'film_name' => 'Побег из Шоушенка',
                'user_email' => 'ivanov@example.com',
                'message' => 'Отличный фильм! Один из лучших, что я когда-либо видел. Сюжет захватывающий, актерская игра на высшем уровне.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Побег из Шоушенка',
                'user_email' => 'petrova@example.com',
                'message' => 'Очень трогательная история о дружбе и надежде. Рекомендую всем посмотреть.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Крестный отец',
                'user_email' => 'sidorov@example.com',
                'message' => 'Классика жанра! Марлон Брандо просто великолепен в роли дона Корлеоне.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Темный рыцарь',
                'user_email' => 'kozlova@example.com',
                'message' => 'Хит Леджер создал незабываемого Джокера. Фильм просто потрясающий!',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Темный рыцарь',
                'user_email' => 'smirnov@example.com',
                'message' => 'Лучший фильм о Бэтмене. Экшн, драма, философия - все на высшем уровне.',
                'is_approved' => 0, 
            ],
            [
                'film_name' => 'Список Шиндлера',
                'user_email' => 'volkova@example.com',
                'message' => 'Очень тяжелый, но важный фильм. Нельзя забывать историю.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Властелин колец: Возвращение короля',
                'user_email' => 'novikov@example.com',
                'message' => 'Эпическое завершение трилогии! Визуальные эффекты и музыка просто потрясающие.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Криминальное чтиво',
                'user_email' => 'morozova@example.com',
                'message' => 'Тарантино в лучшей форме. Диалоги, сюжет, актеры - все идеально.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Форрест Гамп',
                'user_email' => 'lebedev@example.com',
                'message' => 'Трогательная история простого человека. Том Хэнкс великолепен!',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Бойцовский клуб',
                'user_email' => 'sokolova@example.com',
                'message' => 'Фильм, который заставляет задуматься. Неоднозначный, но интересный.',
                'is_approved' => 0,
            ],
            [
                'film_name' => 'Начало',
                'user_email' => 'kuznetsov@example.com',
                'message' => 'Сложный, но захватывающий сюжет. Нолан снова удивил!',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Матрица',
                'user_email' => 'popova@example.com',
                'message' => 'Революционный фильм для своего времени. Эффекты и идея просто потрясающие.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Интерстеллар',
                'user_email' => 'vasiliev@example.com',
                'message' => 'Научная фантастика на высшем уровне. Визуально и эмоционально потрясающий фильм.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Паразиты',
                'user_email' => 'fedorova@example.com',
                'message' => 'Оригинальный сюжет, отличная режиссура. Заслуживает всех наград!',
                'is_approved' => 0, 
            ],
            [
                'film_name' => 'Унесённые призраками',
                'user_email' => 'mikhailov@example.com',
                'message' => 'Шедевр анимации от Миядзаки. Красиво, трогательно, волшебно.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Зеленая миля',
                'user_email' => 'ivanov@example.com',
                'message' => 'Очень эмоциональный фильм. Актерская игра на высшем уровне.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Пианист',
                'user_email' => 'petrova@example.com',
                'message' => 'Тяжелая, но важная история. Отличная работа режиссера и актеров.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Назад в будущее',
                'user_email' => 'sidorov@example.com',
                'message' => 'Классика научной фантастики. Веселый, интересный, с отличным сюжетом.',
                'is_approved' => 1,
            ],
            [
                'film_name' => 'Семь',
                'user_email' => 'kozlova@example.com',
                'message' => 'Мрачный, но захватывающий триллер. Финал просто шокирует.',
                'is_approved' => 0, 
            ],
            [
                'film_name' => 'Властелин колец: Братство Кольца',
                'user_email' => 'smirnov@example.com',
                'message' => 'Отличное начало трилогии. Мир Средиземья создан с любовью и вниманием к деталям.',
                'is_approved' => 1,
            ],
        ];

        foreach ($reviews as $reviewData) {
            $film = $films->firstWhere('name', $reviewData['film_name']);
            $user = $users->firstWhere('email', $reviewData['user_email']);

            if ($film && $user) {
                Review::create([
                    'film_id' => $film->id,
                    'user_id' => $user->id,
                    'message' => $reviewData['message'],
                    'is_approved' => $reviewData['is_approved'],
                ]);
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $film = $films->random();
            $user = $users->random();
            
            $messages = [
                'Отличный фильм, рекомендую!',
                'Очень понравилось, буду пересматривать.',
                'Интересный сюжет, но концовка немного разочаровала.',
                'Хороший фильм для вечернего просмотра.',
                'Не ожидал такого качества, приятно удивлен!',
                'Сюжет затянут, но в целом неплохо.',
                'Визуально очень красиво, но сюжет слабоват.',
                'Отличная актерская игра, особенно главного героя.',
                'Фильм заставляет задуматься о важных вещах.',
                'Рекомендую всем любителям этого жанра.',
            ];

            Review::create([
                'film_id' => $film->id,
                'user_id' => $user->id,
                'message' => $messages[array_rand($messages)],
                'is_approved' => rand(0, 1), // Случайный статус
            ]);
        }
    }
}

