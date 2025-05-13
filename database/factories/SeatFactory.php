<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatFactory extends Factory
{
    protected $model = \App\Models\Seat::class;

    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'row_number' => $this->faker->numberBetween(1, 10),
            'column_number' => $this->faker->numberBetween(1, 10),
            'status' => 'available',
        ];
    }
}