<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(20)->create();
        Article::factory(50)->has(Comment::factory(3))->create();

        $this->call([
            // UserSeeder::class,
            // RoleSeeder::class,

        ]);
    }
}