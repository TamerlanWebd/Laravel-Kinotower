<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Боевик', 'Комедия', 'Драма', 'Фантастика', 
                'Триллер', 'Ужасы', 'Мелодрама', 'Детектив',
                'Приключения', 'Фэнтези', 'Военный', 'Биография'
            ]),
            'parent_id' => null
        ];
    }
}
