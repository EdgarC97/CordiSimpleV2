<?php

namespace App\Http\Controllers;

use App\Notifications\ReservationConfirmation;
use App\Notifications\ReservationCanceledNotification;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = auth()->user()->reservations()->where('status', 'Agendada')->with('event')->get();

        return view('reservations.' . (Auth::user()->is_admin ? 'index' : 'userindex'), compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create(ReservationRequest $request)
    {
        $reservation = $this->createReservation($request->validated());
    }

    public function storeForEvent($eventId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agendar un evento.');
        }

        $event = Event::find($eventId);

        if (!$this->checkEventAvailability($event)) {
            return redirect()->route('dashboard', $eventId)->with('error', 'Este evento no tiene cupos disponibles o está cancelado.');
        }

        $existingReservation = Reservation::where('user_id', $user->id)->where('event_id', $eventId)
            ->where('status', 'Agendada')->first();

        if ($existingReservation) {
            return redirect()->route('dashboard', $eventId)->with('error', 'Ya tienes una reserva para este evento.');
        }

        $reservation = $this->createReservation([
            'status' => 'Agendada',
            'user_id' => $user->id,
            'event_id' => $eventId,
        ]);

        $event->decrement('availableSpots');


        // Enviar la notificación al usuario
        $user->notify(new ReservationConfirmation($reservation));

        return redirect()->route('events.usershow', $eventId)
            ->with('success', 'Reserva creada exitosamente.');

        return redirect()->route('dashboard', $eventId)->with('success', 'Reserva creada exitosamente.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $this->createReservation($request->validated());
        return redirect()->route('reservations.index')->with('success', 'reservacion creada con éxito.');
    }

    /**
     * Display the specified reservation.
     */
    public function show($id)
    {
        $reservation = Reservation::with(['user', 'event'])->findOrFail($id);
        return response()->json($reservation);
    }

    /**
     * Show the form for editing the specified reservation.
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified reservation in storage.
     */
    public function update(ReservationRequest $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->validated());
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $this->updateEventSpots($reservation->event_id, 'increment');
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'La reserva ha sido eliminada exitosamente.');
    }

    public function indexAdmin()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    public function updateStatus($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'Cancelado']);
        $this->updateEventSpots($reservation->event_id, 'increment');


        $event = Event::find($reservation->event_id);
        if ($event && $event->availableSpots < $event->max_capacity) {
            $event->increment('availableSpots');
        }
        // Redirige a la ruta `reservations.index` con un mensaje de éxito

        return redirect()->route('reservations.userindex')->with('success', 'La reserva ha sido cancelada exitosamente.');
    }

    /**
     * Helper methods
     */
    private function createReservation(array $data)
    {
        return Reservation::create($data);
    }

    private function checkEventAvailability($event)
    {
        return $event && $event->availableSpots > 0 && $event->status !== 'Cancelado';
    }

    private function updateEventSpots($eventId, $operation = 'decrement')
    {
        $event = Event::find($eventId);
        if ($event && ($event->availableSpots < $event->max_capacity || $operation === 'decrement')) {
            $event->$operation('availableSpots');
        }
    }



    // En tu ReservationController
    public function cancel(Request $request, $id)
    {
        // Obtener la reserva
        $reservation = Reservation::findOrFail($id);

        // Cambiar el estado de la reserva a cancelada (o eliminarla)
        $reservation->status = 'cancelada'; // o usar $reservation->delete();
        $reservation->save();

        // Obtener el usuario que hizo la reserva
        $user = $reservation->user;

        // Enviar notificación al usuario
        $user->notify(new ReservationCanceledNotification($reservation));

        // Redirigir o retornar respuesta
        return redirect()->route('reservations.index')->with('success', 'Reserva cancelada y notificación enviada.');
    }
}
