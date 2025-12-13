<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $genders = Gender::pluck('id')->toArray();
        
        if (empty($genders)) {
            $this->command->warn('Сначала нужно запустить GenderSeeder!');
            return;
        }

        // Создаем 15 пользователей
        $users = [
            [
                'fio' => 'Иванов Иван Иванович',
                'email' => 'ivanov@example.com',
                'birthday' => '1990-05-15',
                'gender_id' => $genders[0], // Мужской
            ],
            [
                'fio' => 'Петрова Мария Сергеевна',
                'email' => 'petrova@example.com',
                'birthday' => '1995-08-22',
                'gender_id' => $genders[1], // Женский
            ],
            [
                'fio' => 'Сидоров Алексей Петрович',
                'email' => 'sidorov@example.com',
                'birthday' => '1988-12-03',
                'gender_id' => $genders[0],
            ],
            [
                'fio' => 'Козлова Елена Владимировна',
                'email' => 'kozlova@example.com',
                'birthday' => '1992-03-18',
                'gender_id' => $genders[1],
            ],
            [
                'fio' => 'Смирнов Дмитрий Александрович',
                'email' => 'smirnov@example.com',
                'birthday' => '1987-07-25',
                'gender_id' => $genders[0],
            ],
            [
                'fio' => 'Волкова Анна Дмитриевна',
                'email' => 'volkova@example.com',
                'birthday' => '1993-09-10',
                'gender_id' => $genders[1],
            ],
            [
                'fio' => 'Новиков Сергей Игоревич',
                'email' => 'novikov@example.com',
                'birthday' => '1991-11-30',
                'gender_id' => $genders[0],
            ],
            [
                'fio' => 'Морозова Ольга Николаевна',
                'email' => 'morozova@example.com',
                'birthday' => '1994-04-14',
                'gender_id' => $genders[1],
            ],
            [
                'fio' => 'Лебедев Павел Викторович',
                'email' => 'lebedev@example.com',
                'birthday' => '1989-06-08',
                'gender_id' => $genders[0],
            ],
            [
                'fio' => 'Соколова Татьяна Андреевна',
                'email' => 'sokolova@example.com',
                'birthday' => '1996-01-20',
                'gender_id' => $genders[1],
            ],
            [
                'fio' => 'Кузнецов Андрей Сергеевич',
                'email' => 'kuznetsov@example.com',
                'birthday' => '1990-10-05',
                'gender_id' => $genders[0],
            ],
            [
                'fio' => 'Попова Наталья Валерьевна',
                'email' => 'popova@example.com',
                'birthday' => '1992-02-28',
                'gender_id' => $genders[1],
            ],
            [
                'fio' => 'Васильев Максим Олегович',
                'email' => 'vasiliev@example.com',
                'birthday' => '1986-08-12',
                'gender_id' => $genders[0],
            ],
            [
                'fio' => 'Федорова Юлия Романовна',
                'email' => 'fedorova@example.com',
                'birthday' => '1995-05-07',
                'gender_id' => $genders[1],
            ],
            [
                'fio' => 'Михайлов Роман Денисович',
                'email' => 'mikhailov@example.com',
                'birthday' => '1993-12-15',
                'gender_id' => $genders[0],
            ],
        ];

        foreach ($users as $userData) {
            User::create([
                'fio' => $userData['fio'],
                'email' => $userData['email'],
                'password' => Hash::make('password'), // Стандартный пароль для всех
                'birthday' => $userData['birthday'],
                'gender_id' => $userData['gender_id'],
            ]);
        }
    }
}

