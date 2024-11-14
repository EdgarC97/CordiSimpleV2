<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function indexReservation()
    {
        $events = Event::all();
        return view('reservations.userindex', compact('events'));
    }

    public function indexDashboard()
    {
        $events = Event::all();
        return view('dashboard', compact('events'));
    }
    public function indexWelcome()
    {
        $events = Event::all();
        return view('welcome', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        // Valida los datos ingresados
        $validatedData = $request->all();

        // Crea y guarda un nuevo Event
        Event::create($validatedData);

        // Redirecciona con un mensaje de éxito
        return redirect()->route('events.index')->with('success', 'Evento creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        if ($event == null) {
            return view('events.show')->with('error', 'evento eliminado');
        } else {
            return view('events.show', compact('event'));
        }
    }

    public function usershow($id)
    {
        $event = Event::findOrFail($id);
        return view('events.usershow', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        $validatedData = $request->all();

        $event = Event::findOrFail($id);
        $event->update($validatedData);

        return redirect()->route('events.index')->with('success', 'Evento actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito.');
    }
}
