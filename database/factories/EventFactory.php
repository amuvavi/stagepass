<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = \App\Models\Event::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'date' => now()->addDays(rand(1, 30)),
            'rows' => 10,
            'columns' => 10,
        ];
    }
}