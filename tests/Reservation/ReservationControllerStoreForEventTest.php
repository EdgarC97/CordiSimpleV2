<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReservationConfirmation;

class ReservationControllerStoreForEventTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_store_reservation_for_event()
    {
        Notification::fake();

        $user = User::factory()->create();
        $event = Event::factory()->create(['availableSpots' => 10]);

        /**
         * @var \App\Models\User $user
         */
        $this->actingAs($user);
        $response = $this->post(route('reservations.storeForEvent', $event->id));

        $response->assertRedirect(route('events.usershow', $event->id));
        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'event_id' => $event->id,
            'status' => 'Agendada'
        ]);

        Notification::assertSentTo($user, ReservationConfirmation::class);
    }
}
