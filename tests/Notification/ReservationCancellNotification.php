<?php

namespace Tests\Notification;

use App\Models\User;
use App\Models\Event;
use App\Models\Reservation;
use App\Notifications\ReservationCanceledNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ReservationCancellNotification extends TestCase
{
    public function test_notification_is_sent_on_event_cancellation()
    {
        Notification::fake();

        // Crea usuario, evento, y reserva
        $user = User::factory()->create();
        $event = Event::factory()->create();
        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);

        // Envía la notificación de cancelación
        $user->notify(new ReservationCanceledNotification($reservation));

        // Verifica que la notificación se envió correctamente
        Notification::assertSentTo(
            [$user],
            ReservationCanceledNotification::class
        );
    }
}
