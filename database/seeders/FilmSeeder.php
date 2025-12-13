<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Country;
use App\Models\Film;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FilmSeeder extends Seeder
{
    public function run(): void
    {
        // Отключаем проверку внешних ключей для очистки таблиц
        Schema::disableForeignKeyConstraints();
        DB::table('category_films')->truncate();
        Film::truncate();
        Country::truncate();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Создаем Жанры
        $genres = [
            'Драма', 'Фантастика', 'Боевик', 'Триллер', 'Комедия', 'Криминал', 
            'Приключения', 'Фэнтези', 'Биография', 'Вестерн'
        ];
        $genreIds = [];
        foreach ($genres as $genreName) {
            $cat = Category::create(['name' => $genreName]);
            $genreIds[$genreName] = $cat->id;
        }

        // 2. Создаем Страны
        $countriesList = ['США', 'Великобритания', 'Франция', 'Япония', 'Россия', 'Италия', 'Германия', 'Новая Зеландия'];
        $countryIds = [];
        foreach ($countriesList as $countryName) {
            $c = Country::create(['name' => $countryName]);
            $countryIds[$countryName] = $c->id;
        }

        // 3. Список из 20 фильмов с рабочими ссылками
        $movies = [
            [
                'name' => 'Побег из Шоушенка',
                'year' => 1994,
                'country' => 'США',
                'genres' => ['Драма', 'Криминал'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/d/de/Movie_poster_the_shawshank_redemption.jpg',
                'desc' => 'Бухгалтер Энди Дюфрейн обвинён в убийстве собственной жены и её любовника.',
            ],
            [
                'name' => 'Крестный отец',
                'year' => 1972,
                'country' => 'США',
                'genres' => ['Криминал', 'Драма'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/c/c4/Godfather_vhs.jpg',
                'desc' => 'Криминальная сага, повествующая о нью-йоркской сицилийской мафиозной семье Корлеоне.',
            ],
            [
                'name' => 'Темный рыцарь',
                'year' => 2008,
                'country' => 'США',
                'genres' => ['Боевик', 'Криминал', 'Драма'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/1/18/The_Dark_Knight_Poster.jpg',
                'desc' => 'Бэтмен поднимает ставки в войне с криминалом. С помощью лейтенанта Джима Гордона и прокурора Харви Дента.',
            ],
            [
                'name' => 'Список Шиндлера',
                'year' => 1993,
                'country' => 'США',
                'genres' => ['Биография', 'Драма'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/3/38/Schindler%27s_List_movie.jpg',
                'desc' => 'Фильм рассказывает реальную историю загадочного Оскара Шиндлера, члена нацистской партии.',
            ],
            [
                'name' => 'Властелин колец: Возвращение короля',
                'year' => 2003,
                'country' => 'Новая Зеландия',
                'genres' => ['Фэнтези', 'Приключения'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/6/62/ReturnOfTheKingPoster.jpg',
                'desc' => 'Последняя часть трилогии о Кольце Всевластия и о героях, спасающих Средиземье.',
            ],
            [
                'name' => 'Криминальное чтиво',
                'year' => 1994,
                'country' => 'США',
                'genres' => ['Криминал', 'Драма'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/9/93/Pulp_Fiction.jpg',
                'desc' => 'Двое бандитов Винсент Вега и Джулс Винфилд ведут философские беседы в перерывах между разборками.',
            ],
            [
                'name' => 'Властелин колец: Братство Кольца',
                'year' => 2001,
                'country' => 'Новая Зеландия',
                'genres' => ['Фэнтези', 'Приключения'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/0/08/The_Fellowship_of_the_Ring_poster.jpg',
                'desc' => 'Сказания о Средиземье — это хроника Великой войны за Кольцо, войны, длившейся тысячи лет.',
            ],
            [
                'name' => 'Форрест Гамп',
                'year' => 1994,
                'country' => 'США',
                'genres' => ['Драма', 'Комедия'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/d/d5/Forrest_gump.jpg',
                'desc' => 'От лица главного героя Форреста Гампа, слабоумного безобидного человека с благородным и открытым сердцем.',
            ],
            [
                'name' => 'Бойцовский клуб',
                'year' => 1999,
                'country' => 'США',
                'genres' => ['Драма', 'Триллер'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/8/8a/Fight_club.jpg',
                'desc' => 'Сотрудник страховой компании страдает хронической бессонницей и отчаянно пытается вырваться из мучительно скучной жизни.',
            ],
            [
                'name' => 'Начало',
                'year' => 2010,
                'country' => 'США',
                'genres' => ['Фантастика', 'Боевик'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/b/bc/Poster_Inception_film_2010.jpg',
                'desc' => 'Кобб — талантливый вор, лучший из лучших в опасном искусстве извлечения: он крадет ценные секреты из глубин подсознания.',
            ],
            [
                'name' => 'Матрица',
                'year' => 1999,
                'country' => 'США',
                'genres' => ['Фантастика', 'Боевик'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/9/9d/Matrix-DVD.jpg',
                'desc' => 'Жизнь Томаса Андерсона разделена на две части: днём он — самый обычный офисный работник, а ночью превращается в хакера по имени Нео.',
            ],
            [
                'name' => 'Славные парни',
                'year' => 1990,
                'country' => 'США',
                'genres' => ['Биография', 'Криминал'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/8/82/Goodfellas_poster.jpg',
                'desc' => 'История Генри Хилла — начинающего гангстера, занимающегося грабежами вместе с Джимми Конвеем и Томми Де Вито.',
            ],
            [
                'name' => 'Пролетая над гнездом кукушки',
                'year' => 1975,
                'country' => 'США',
                'genres' => ['Драма'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/2/26/One_Flew_Over_the_Cuckoo%27s_Nest_poster.jpg',
                'desc' => 'Сымитировав помешательство в надежде избежать тюремного заключения, Рэндл Патрик МакМерфи попадает в психиатрическую клинику.',
            ],
            [
                'name' => 'Семь',
                'year' => 1995,
                'country' => 'США',
                'genres' => ['Криминал', 'Триллер'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/2/26/Seven_ver1.jpg',
                'desc' => 'Детектив Уильям Сомерсет — ветеран уголовного сыска, мечтающий уйти на пенсию и уехать подальше от города.',
            ],
            [
                'name' => 'Интерстеллар',
                'year' => 2014,
                'country' => 'США',
                'genres' => ['Фантастика', 'Драма'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/c/c3/Interstellar_2014.jpg',
                'desc' => 'Когда засуха, пыльные бури и вымирание растений приводят человечество к продовольственному кризису, коллектив исследователей отправляется в путешествие.',
            ],
            [
                'name' => 'Паразиты',
                'year' => 2019,
                'country' => 'Япония', // На самом деле Корея, но используем из списка доступных
                'genres' => ['Триллер', 'Драма'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/ba/Parasite2019_poster.jpg',
                'desc' => 'Обычное корейское семейство жизнь не балует. Приходится жить в сыром грязном полуподвале, воровать интернет у соседей.',
            ],
            [
                'name' => 'Унесённые призраками',
                'year' => 2001,
                'country' => 'Япония',
                'genres' => ['Фэнтези', 'Приключения'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/6/61/Spirited_away.jpg',
                'desc' => 'Тихиро с мамой и папой переезжают в новый дом. Заблудившись по дороге, они оказываются в странном пустынном городе.',
            ],
            [
                'name' => 'Зеленая миля',
                'year' => 1999,
                'country' => 'США',
                'genres' => ['Фэнтези', 'Драма'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/c/ce/Green_mile.jpg',
                'desc' => 'Пол Эджкомб — начальник блока смертников в тюрьме «Холодная гора», каждый из узников которого однажды проходит «зеленую милю».',
            ],
            [
                'name' => 'Пианист',
                'year' => 2002,
                'country' => 'Франция',
                'genres' => ['Биография', 'Драма'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/a/a7/Pianist_post.jpg',
                'desc' => 'Фильм повествует о судьбе Владислава Шпильмана — выдающегося польского пианиста, еврея по национальности.',
            ],
            [
                'name' => 'Назад в будущее',
                'year' => 1985,
                'country' => 'США',
                'genres' => ['Фантастика', 'Комедия'],
                'img' => 'https://upload.wikimedia.org/wikipedia/ru/d/d2/Back_to_the_Future.jpg',
                'desc' => 'Подросток Марти с помощью машины времени, сооружённой его другом-профессором доком Брауном, попадает из 80-х в далекие 50-е.',
            ],
        ];

        foreach ($movies as $data) {
            // Находим ID страны (если нет в списке, берем первую попавшуюся)
            $countryId = $countryIds[$data['country']] ?? array_values($countryIds)[0];

            $film = Film::create([
                'name' => $data['name'],
                'description' => $data['desc'],
                'country_id' => $countryId,
                'duration' => rand(90, 180),
                'year_of_issue' => $data['year'],
                'age' => rand(0, 1) ? 16 : 12, // Упростим возраст
                'link_img' => $data['img'],
                'link_kinopoisk' => 'https://www.kinopoisk.ru/',
                'link_video' => 'https://www.youtube.com/',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Привязываем жанры
            $idsToSync = [];
            foreach ($data['genres'] as $gName) {
                if (isset($genreIds[$gName])) {
                    $idsToSync[] = $genreIds[$gName];
                }
            }
            $film->categories()->sync($idsToSync);
        }
    }
}