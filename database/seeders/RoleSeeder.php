<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role' => 'moderator'
        ]);
        Role::create([
            'role' => 'reader'
        ]);
        Role::create([
            'role' => 'author'
        ]);
    }
}