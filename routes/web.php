<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\CheckIfAdmin;

Route::get('/dashboard', [EventController::class, 'indexDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [EventController::class, 'indexWelcome'])
        ->name('welcome');
});

Route::middleware(['auth', CheckIfAdmin::class])->group(function () {
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::post('/users/{user}/role', [UserController::class, 'changeRole'])->name('users.role');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
});

// Mostrar evento para el usuario autenticado (solo si está autenticado)
Route::get('events/users/{id}', [EventController::class, 'usershow'])
    ->middleware('auth') // Solo accesible para usuarios autenticados
    ->name('events.usershow');


//Profiles
Route::get('/user/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/user/update', [UserController::class, 'update'])->name('profile.update');

//Reservation
Route::get('/events/{eventId}/schedule', [ReservationController::class, 'storeForEvent'])->name('reservations.schedule');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.userindex');
Route::post('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
Route::put('/reservations/{id}/cancel', [ReservationController::class, 'updateStatus'])->name('reservations.cancel');
Route::put('/reservations/cancel/{id}', [ReservationController::class, 'cancel'])->name('reservations.cancel');

// Rutas protegidas para el admin (solo autenticados y administradores)
Route::middleware(['auth', CheckIfAdmin::class])->group(function () {
    Route::get('admin/reservations', [ReservationController::class, 'indexAdmin'])->name('reservations.index');
    Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('users', UserController::class);
});

// Tese
Route::post('/reservations/store-for-event/{eventId}', [ReservationController::class, 'storeForEvent'])->name('reservations.storeForEvent');

// Incluir las rutas de autenticación
require __DIR__ . '/auth.php';
