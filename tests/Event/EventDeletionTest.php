<?php

namespace Tests\Event;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventDeletionTest extends TestCase
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

    public function test_admin_can_delete_event(): void
    {
        $response = $this->actingAs($this->admin)
            ->delete(route('events.destroy', $this->event));

        $response->assertRedirect(route('events.index'))
            ->assertSessionHas('success', 'Evento eliminado con éxito.');

        $this->assertDatabaseMissing('events', [
            'id' => $this->event->id
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