<?php

namespace Tests\Event;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventEditTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private User $admin;
    private User $regularUser;
    private Event $event;

    /**
     * Configuración inicial para las pruebas.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Crear usuario administrador
        $this->admin = $this->createAdmin(); // Método de ayuda que hemos agregado

        // Crear usuario regular
        $this->regularUser = $this->createRegularUser(); // Método de ayuda que hemos agregado

        // Crear un evento usando la fábrica (sin asignar el ID)
        $this->event = Event::factory()->create([
            'name' => 'Concierto de Rock',
            'description' => 'Un gran evento',
            'date' => '2025-06-26',
            'time' => '16:00',
            'location' => 'Auditorio Nacional',
            'max_capacity' => 200,
            'availableSpots' => 150,
            'status' => 'Activo',
        ]);
    }

    /**
     * Verificar que el administrador puede acceder a la página de edición de eventos.
     */
    public function test_admin_can_access_edit_event_page(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('events.edit', $this->event));

        $response->assertStatus(200)
            ->assertViewIs('events.edit')
            ->assertViewHas('event', $this->event);
    }

    /**
     * Verificar que un usuario regular no puede acceder a la página de edición de eventos.
     */
    public function test_regular_user_cannot_access_edit_event_page(): void
    {
        $response = $this->actingAs($this->regularUser)
            ->get(route('events.edit', $this->event));

        $response->assertStatus(403);  // Acceso denegado (Forbidden)
    }

    /**
     * Verificar que un administrador puede actualizar un evento correctamente.
     */
    public function test_admin_can_update_event(): void
    {
        $updatedEventData = [
            'name' => 'Evento Actualizado',
            'description' => 'Descripción actualizada del evento',
            'date' => '2025-11-10',
            'time' => '16:00',
            'location' => 'Nuevo Centro de Convenciones',
            'max_capacity' => 150,
            'availableSpots' => 150,
            'status' => 'Inactive',
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('events.update', $this->event->id), $updatedEventData);

        $response->assertRedirect(route('events.index'))
            ->assertSessionHas('success', 'Evento actualizado con exito');

        $this->event->refresh();  // Refresca el evento para obtener los últimos datos de la base de datos

        $this->assertEquals('Evento Actualizado', $this->event->name);
        $this->assertEquals('Nuevo Centro de Convenciones', $this->event->location);
        $this->assertEquals('Inactive', $this->event->status);
    }


    /**
     * Verificar validaciones del formulario de actualización de evento.
     */
    public function test_validate_update_event_form(): void
    {
        $updatedEventData = [
            'name' => '', // Nombre vacío
            'date' => date('Y-m-d', strtotime('-1 day')), // Fecha pasada
            'time' => '25:00', // Hora inválida
            'max_capacity' => 0, // Capacidad no válida
            'availableSpots' => -10 // Espacios disponibles negativos
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('events.update', $this->event), $updatedEventData);

        // Verificar que los errores sean correctos
        $response->assertSessionHasErrors([
            'name',
            'date',
            'time',
            'max_capacity',
            'availableSpots'
        ]);
    }
}
