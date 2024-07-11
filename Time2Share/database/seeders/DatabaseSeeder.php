<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Item;
use App\Models\Review;
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
        // User::factory(10)->create();

        User::factory(10)->create([

            Item::factory(10)->create(),
            Contract::factory(5)->create(),
            Review::factory(5)->create(),

        ]);
    }
}
