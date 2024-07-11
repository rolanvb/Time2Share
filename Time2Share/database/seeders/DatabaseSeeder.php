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

        User::factory(10)->create()->each(function ($user) {
            // For each user, create a random number of items
            Item::factory(random_int(2, 10))->create([
                'owner_id' => $user->id
            ]);

            // For each user, create a random number of contracts
            Contract::factory(random_int(0, 8))->create([
                'owner_id' => $user->id,
                'contractor_id' => User::inRandomOrder()->first()->id
            ]);

            // For each user, create a random number of reviews
            Review::factory(random_int(1, 3))->create([
                'reviewer_id' => $user->id,
                'reviewed_user_id' => User::inRandomOrder()->first()->id
            ]);
        });
    }
}
