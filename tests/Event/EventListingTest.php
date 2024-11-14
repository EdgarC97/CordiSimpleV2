<?php

namespace Tests\Event;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventListingTest extends TestCase
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

        // Crear eventos de prueba
        Event::factory()->count(10)->create();
    }

    public function test_admin_can_view_event_listing(): void
    {
        $response = $this->actingAs($this->admin)
            ->get(route('events.index'));

        $response->assertStatus(200)
            ->assertViewIs('events.index')
            ->assertViewHas('events');
    }

    public function test_regular_user_cannot_access_event_listing(): void
    {
        $response = $this->actingAs($this->regularUser)
            ->get(route('events.index')); // Esto es la ruta protegida para administradores

        // El acceso debe ser denegado para un usuario regular
        $response->assertStatus(403);  // Forbidden, porque está protegido por el middleware de admin
    }


    public function test_event_listing_shows_correct_details(): void
    {
        $event = Event::first();

        $response = $this->actingAs($this->admin)
            ->get(route('events.index'));

        $response->assertSeeText($event->name)
            ->assertSeeText($event->date)
            ->assertSeeText($event->location)
            ->assertSeeText($event->max_capacity)
            ->assertSeeText($event->availableSpots);
    }

    // public function test_event_listing_can_be_filtered(): void
    // {
    //     $event = Event::first();

    //     $response = $this->actingAs($this->admin)
    //         ->get(route('events.index', ['date' => $event->date]));

    //     $response->assertSeeText($event->name)
    //         ->assertDontSee(Event::skip(1)->first()->name);
    // }
}
