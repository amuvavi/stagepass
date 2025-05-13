<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Event;
use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    protected $model = \App\Models\Purchase::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
            'seat_id' => Seat::factory(),
            'purchased_at' => now(),
        ];
    }
}