<?php

namespace Tests\Notification;


use App\Models\User;
use App\Models\Event;
use App\Models\Reservation;
use App\Notifications\ReservationConfirmation;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;


class ReservationNotificationTest extends TestCase
{
    /**
     * Testea que se envíe una notificación cuando se realiza una reserva.
     *
     * @return void
     */
    public function test_notification_is_sent_on_reservation()
    {
        // Faker para no enviar correos reales
        Notification::fake();

        // Crea un usuario, un evento y una reserva usando las fábricas
        $user = User::factory()->create();
        $event = Event::factory()->create();

        // Usa la fábrica de Reservation directamente para crear la reserva
        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ]);

        // Llama al método que envía la notificación
        $reservation->sendConfirmationNotification();  // Este método debe existir en el modelo

        // Verifica que la notificación se haya enviado al usuario
        Notification::assertSentTo(
            [$user], // El usuario que debe recibir la notificación
            ReservationConfirmation::class // La clase de la notificación
        );
    }
}
