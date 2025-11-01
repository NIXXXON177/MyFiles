<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'login' => 'admin',
            'email' => 'admin@test.ru',
            'fio' => 'Admin Admin',
            'phone' => '+7(999)-999-99-99',
            'password' => 'gruzovik2024',
            'role' => true,
        ]);


        $val = ['хрупкое', 'скоропортящееся', 'требуется рефрижератор', 'животные', 'жидкость', 'мебель'];

        foreach ($val as $v) {
            Cargo::create([
                'name' => $v
            ]);
        }
    }
}
