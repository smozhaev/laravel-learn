<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'moderator',
            'email' => 'moderator@mail.ru',
            'password' => Hash::make('123456'),
            'role_id' => 1,

            'author_desc' => 'moder desc',

        ]);

        \App\Models\User::create([
            'name' => 'reader',
            'email' => 'reader@mail.ru',
            'password' => Hash::make('123456'),
            'role_id' => 2,

            'author_desc' => 'reader desc',
        ]);

        \App\Models\User::create([
            'name' => 'author',
            'email' => 'author@mail.ru',
            'password' => Hash::make('123456'),
            'role_id' => 3,

            'author_desc' => 'author desc',
        ]);
    }
}