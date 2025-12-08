<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'США', 'Россия', 'Великобритания', 'Франция', 
            'Германия', 'Италия', 'Испания', 'Япония',
            'Южная Корея', 'Китай', 'Индия', 'Канада',
            'Австралия', 'Мексика', 'Бразилия'
        ];
        
        foreach ($countries as $country) {
            Country::create(['name' => $country]);
        }
    }
}
