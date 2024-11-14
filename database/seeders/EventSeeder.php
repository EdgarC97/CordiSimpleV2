<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run()
    {
        $events = [
            [
                'name' => 'Concierto de Rock',
                'description' => 'Un concierto de rock en vivo con varias bandas locales.',
                'date' => '2024-12-10',
                'time' => '19:00',
                'location' => 'Auditorio Nacional',
                'max_capacity' => 500,
                'availableSpots' => 450,
                'status' => 'Activo',
                'image_url' => 'https://cdn.pixabay.com/photo/2021/12/13/21/43/drummer-6869168_1280.jpg',
            ],
            [
                'name' => 'Feria Gastronómica',
                'description' => 'Evento de comida y cultura con más de 50 puestos de comida.',
                'date' => '2024-11-15',
                'time' => '12:00',
                'location' => 'Parque Central',
                'max_capacity' => 1000,
                'availableSpots' => 900,
                'status' => 'Activo',
                'image_url' => 'https://cdn.pixabay.com/photo/2015/04/26/09/43/cottages-vacation-rentals-740179_1280.jpg',
            ],
            [
                'name' => 'Exposición de Arte',
                'description' => 'Exhibición de arte moderno de artistas locales.',
                'date' => '2024-12-01',
                'time' => '10:00',
                'location' => 'Museo de Arte',
                'max_capacity' => 300,
                'availableSpots' => 290,
                'status' => 'Activo',
                'image_url' => 'https://cdn.pixabay.com/photo/2023/12/05/15/26/exhibition-8431913_1280.jpg',
            ],
            [
                'name' => 'Maratón Anual',
                'description' => 'Maratón anual de 10 km.',
                'date' => '2024-10-30',
                'time' => '06:00',
                'location' => 'Ciudad Deportiva',
                'max_capacity' => 2000,
                'availableSpots' => 1950,
                'status' => 'Activo',
                'image_url' => 'https://cdn.pixabay.com/photo/2021/09/27/10/02/marathon-6660178_1280.jpg',
            ],
            [
                'name' => 'Conferencia de Tecnología',
                'description' => 'Conferencia sobre avances en tecnología y software.',
                'date' => '2024-11-20',
                'time' => '09:00',
                'location' => 'Centro de Convenciones',
                'max_capacity' => 800,
                'availableSpots' => 750,
                'status' => 'Activo',
                'image_url' => 'https://cdn.pixabay.com/photo/2017/08/10/18/26/business-2626052_1280.jpg',
            ],
            [
                'name' => 'Torneo de Ajedrez',
                'description' => 'Competencia anual de ajedrez para todas las edades.',
                'date' => '2024-11-25',
                'time' => '08:00',
                'location' => 'Club de Ajedrez',
                'max_capacity' => 150,
                'availableSpots' => 130,
                'status' => 'Activo',
                'image_url' => 'https://cdn.pixabay.com/photo/2017/09/08/20/29/chess-2730034_1280.jpg',
            ],
        ];

        foreach ($events as $event) {
            Event::firstOrCreate(
                ['name' => $event['name']],
                [
                    'description' => $event['description'],
                    'date' => $event['date'],
                    'time' => $event['time'],
                    'location' => $event['location'],
                    'max_capacity' => $event['max_capacity'],
                    'availableSpots' => $event['availableSpots'],
                    'status' => $event['status'],
                    'image_url' => $event['image_url'],
                ]
            );
        }
    }
}
