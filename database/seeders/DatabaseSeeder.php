<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GenderSeeder::class,
            CountrySeeder::class,
            CategorySeeder::class,
            FilmSeeder::class,
            UserSeeder::class,
            ReviewSeeder::class,
            RatingSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
