<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text(255),
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'time' => $this->faker->time(),
            'location' => $this->faker->city(),
            'max_capacity' => $this->faker->numberBetween(10, 200),
            'availableSpots' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['Active', 'Cancelado']),
        ];
    }
}
