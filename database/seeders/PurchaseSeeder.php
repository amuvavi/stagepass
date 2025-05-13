<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\Seat;
use App\Models\User;
use Carbon\Carbon;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure we have at least a few users to associate purchases with
        if (User::count() < 5) {
            \App\Models\User::factory()->count(5)->create();
        }

        $users = User::pluck('id')->toArray();

        // Get 100 available seats at random
        $availableSeats = Seat::where('status', 'available')->inRandomOrder()->limit(100)->get();

        foreach ($availableSeats as $seat) {
            $userId = $users[array_rand($users)];

            Purchase::create([
                'user_id' => $userId,
                'event_id' => $seat->event_id,
                'seat_id' => $seat->id,
                'purchased_at' => Carbon::now()->subDays(rand(0, 10)),
            ]);

            // Mark the seat as sold
            $seat->status = 'sold';
            $seat->save();
        }
    }
}

