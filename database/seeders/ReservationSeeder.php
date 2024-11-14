<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Event;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // Obtener todos los usuarios y eventos
        $users = User::all();
        $events = Event::all();

        // Crear reservas aleatorias
        foreach ($users as $user) {
            // Asigna aleatoriamente entre 1 y 3 reservas a cada usuario
            $eventSamples = $events->random(rand(1, 3));
            foreach ($eventSamples as $event) {
                Reservation::create([
                    'status' => 'confirmed', // Puedes ajustar el valor de estado según tus necesidades
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                ]);
            }
        }
    }
}
