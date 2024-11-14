<?php

namespace Tests\Event;

use App\Models\User;
use App\Models\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;

class EventCreationTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private User $admin;
    private User $regularUser;

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
    }

    public function test_admin_can_access_create_event_page(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('events.create'));

        $response->assertStatus(200)
            ->assertViewIs('events.create');
    }

    public function test_admin_can_create_valid_event(): void
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

        $response = $this->actingAs($this->admin)
            ->post(route('events.store'), $eventData);

        $response->assertRedirect(route('events.index'))
            ->assertSessionHas('success', 'Evento creado con éxito.');

        $this->assertDatabaseHas('events', [
            'name' => 'Evento de Prueba',
            'location' => 'Centro de Convenciones'
        ]);
    }

    public function test_validate_required_fields(): void
    {
        $response = $this->actingAs($this->admin)
            ->post(route('events.store'), []);

        $response->assertSessionHasErrors([
            'name',
            'date',
            'time',
            'location',
            'max_capacity',
            'availableSpots',
            'status'
        ]);
    }

    public function test_validate_future_date(): void
    {
        $eventData = [
            'name' => 'Evento de Prueba',
            'description' => 'Descripción del evento de prueba',
            'date' => date('Y-m-d', strtotime('-1 day')), // Fecha pasada
            'time' => '14:00',
            'location' => 'Centro de Convenciones',
            'max_capacity' => 100,
            'availableSpots' => 100,
            'status' => 'Active'
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('events.store'), $eventData);

        $response->assertSessionHasErrors(['date']);
    }

    public function test_validate_time_format(): void
    {
        $eventData = [
            'name' => 'Evento de Prueba',
            'description' => 'Descripción del evento de prueba',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '25:00', // Formato de hora inválido
            'location' => 'Centro de Convenciones',
            'max_capacity' => 100,
            'availableSpots' => 100,
            'status' => 'Active'
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('events.store'), $eventData);

        $response->assertSessionHasErrors(['time']);
    }

    public function test_event_name_max_length(): void
    {
        $eventData = [
            'name' => str_repeat('a', 256), // Nombre demasiado largo
            'description' => 'Descripción del evento de prueba',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '14:00',
            'location' => 'Centro de Convenciones',
            'max_capacity' => 100,
            'availableSpots' => 100,
            'status' => 'Active'
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('events.store'), $eventData);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_description_max_length(): void
    {
        $eventData = [
            'name' => 'Evento de Prueba',
            'description' => str_repeat('a', 501), // Descripción demasiado larga
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '14:00',
            'location' => 'Centro de Convenciones',
            'max_capacity' => 100,
            'availableSpots' => 100,
            'status' => 'Active'
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('events.store'), $eventData);

        $response->assertSessionHasErrors(['description']);
    }

    public function test_validate_positive_capacity(): void
    {
        $eventData = [
            'name' => 'Evento de Prueba',
            'description' => 'Descripción del evento de prueba',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '14:00',
            'location' => 'Centro de Convenciones',
            'max_capacity' => 0, // Capacidad inválida
            'availableSpots' => 100,
            'status' => 'Active'
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('events.store'), $eventData);

        $response->assertSessionHasErrors(['max_capacity']);
    }

    public function test_validate_non_negative_available_spots(): void
    {
        $eventData = [
            'name' => 'Evento de Prueba',
            'description' => 'Descripción del evento de prueba',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '14:00',
            'location' => 'Centro de Convenciones',
            'max_capacity' => 100,
            'availableSpots' => -10, // Valor inválido
            'status' => 'Active'
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('events.store'), $eventData);

        $response->assertSessionHasErrors(['availableSpots']);
    }
}
