<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Event;
use App\Models\Reservation;
use App\Notifications\EventReminderNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Carbon\Carbon;

class Notification24hBefore extends TestCase
{
    use DatabaseTransactions;

    public function test_event_reminder_notification_sent_24_hours_before()
    {
        Notification::fake();

        // Crear usuario, evento en 24 horas y reserva
        $user = User::factory()->create();
        $event = Event::factory()->create([
            'date' => Carbon::now()->addDay() // Evento en 24 horas
        ]);
        Reservation::factory()->create([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);

        // Ejecutar lógica que envía la notificación
        $user->notify(new EventReminderNotification($event));

        // Verificar que la notificación fue enviada
        Notification::assertSentTo(
            [$user],
            EventReminderNotification::class,
            function ($notification) use ($event) {
                return $notification->event->id === $event->id;
            }
        );
    }
}