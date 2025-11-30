<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Categories
        Category::insert([
            ['name' => 'Ножі', 'slug' => 'nozhi'],
            ['name' => 'Рукавички', 'slug' => 'rukavychky'],
            ['name' => 'Пістолети', 'slug' => 'pistolety'],
            ['name' => 'Гвинтівки', 'slug' => 'ghvyntivky'],
            ['name' => 'Снайперські', 'slug' => 'sniper'],
            ['name' => 'Інше', 'slug' => 'inshe'],
        ]);
    }
}
