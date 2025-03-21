<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Kévin',
            'email' => 'test@test.test',
        ]);

        // Restaurant::create([
        //     'name' => "restauland"
        // ]);
        // Restaurant::create([
        //     'name' => "restoto"
        // ]);

        Restaurant::factory(3)->create();
        
        Category::factory(1200)->create();
    }
}
