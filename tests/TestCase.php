<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Configurar el entorno de prueba.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Limpiar caché para que se apliquen todos los cambios, especialmente en las rutas.
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        
    }

    /**
     * Crear un usuario admin para las pruebas.
     *
     * @return \App\Models\User
     */
    protected function createAdmin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    /**
     * Crear un usuario regular para las pruebas.
     *
     * @return \App\Models\User
     */
    protected function createRegularUser(): User
    {
        return User::factory()->create(['role' => 'user']);
    }
}
