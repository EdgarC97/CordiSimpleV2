<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),  
            'event_id' => Event::factory(),  
            'status' => 'confirmed', 
        ];
    }
}
