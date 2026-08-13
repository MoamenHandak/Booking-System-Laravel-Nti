<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Hotel;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $hotels = Hotel::all();

        if ($users->isEmpty() || $hotels->isEmpty()) {
            $this->command->info('No users or hotels found. Skipping ReviewSeeder.');
            return;
        }

        foreach ($hotels as $hotel) {
            for ($i = 0; $i < 3; $i++) {
                Review::create([
                    'user_id' => $users->random()->id,
                    'hotel_id' => $hotel->id,
                    'rating' => rand(1, 5),
                    'comment' => 'Sample review comment number ' . ($i + 1),
                ]);
            }
        }
    }
}