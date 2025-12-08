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
             AdminSeeder::class,
        ]);
    }
}
