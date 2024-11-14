<?php

namespace Tests\Event;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventPermissionsTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private User $admin;
    private User $regularUser;
    private Event $event;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear usuario administrador
        $this->admin = User::factory()->create([
            'role' => 'admin'
        ]);

        // Crear usuario regular
        $this->regularUser = User::factory()->create([
            'role' => 'user'
        ]);

        // Crear un evento de prueba
        $this->event = Event::factory()->create();
    }

    public function test_regular_user_cannot_access_create_event_page(): void
    {
        $response = $this->actingAs($this->regularUser)
            ->get(route('events.create'));

        $response->assertStatus(403);
    }

    public function test_regular_user_cannot_create_event(): void
    {
        $eventData = [
            'name' => 'Evento de Prueba',
            'description' => 'Descripción del evento de prueba',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '14:00',
            'location' => 'Centro de Convenciones',
            'max_capacity' => 100,
            'availableSpots' => 100,
            'status' => 'Active',
            'image_url' => 'https://example.com/image.jpg'
        ];

        $response = $this->actingAs($this->regularUser)
            ->post(route('events.store'), $eventData);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('events', [
            'name' => 'Evento de Prueba'
        ]);
    }

    public function test_regular_user_cannot_edit_event(): void
    {
        $updatedEventData = [
            'name' => 'Evento Actualizado',
            'description' => 'Descripción actualizada del evento',
            'date' => date('Y-m-d', strtotime('+2 days')),
            'time' => '16:00',
            'location' => 'Nuevo Centro de Convenciones',
            'max_capacity' => 150,
            'availableSpots' => 150,
            'status' => 'Inactive'
        ];

        $response = $this->actingAs($this->regularUser)
            ->put(route('events.update', $this->event), $updatedEventData);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('events', [
            'id' => $this->event->id,
            'name' => 'Evento Actualizado'
        ]);
    }

    public function test_regular_user_cannot_delete_event(): void
    {
        $response = $this->actingAs($this->regularUser)
            ->delete(route('events.destroy', $this->event));

        $response->assertStatus(403);

        $this->assertDatabaseHas('events', [
            'id' => $this->event->id
        ]);
    }
}