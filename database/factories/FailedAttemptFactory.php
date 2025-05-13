<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Event;
use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

class FailedAttemptFactory extends Factory
{
    protected $model = \App\Models\FailedAttempt::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
            'seat_id' => Seat::factory(),
            'attempted_at' => now(),
            'reason' => $this->faker->sentence,
        ];
    }
}