<x-app-layout>
    @section('title', 'Mis reservas')
    @section('content')
        <div class="flex flex-col min-h-screen">
            <div class="container mx-auto py-8 flex-grow">

                @if ($reservations->isEmpty())
                    <p class="text-center text-gray-500">No tienes eventos reservados.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($reservations as $reservation)
                            @if ($reservation->event != null)
                                <div
                                    class="block p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                                    <h5 class="text-2xl font-semibold mb-2 text-gray-800">{{ $reservation->event->name }}
                                    </h5>
                                    <h5 class="text-2xl font-semibold mb-2 text-gray-800">
                                        {{ $reservation->event->availableSpots }}</h5>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($reservation->event->description, 100) }}</p>
                                    <div class="text-sm text-gray-500 mb-2">
                                        <span class="font-semibold">Fecha:</span>
                                        {{ \Carbon\Carbon::parse($reservation->event->date)->format('d-m-Y') }} |
                                        <span class="font-semibold">Hora:</span>
                                        {{ \Carbon\Carbon::parse($reservation->event->time)->format('H:i') }}
                                    </div>
                                    <div class="text-sm text-gray-500 mb-2 flex justify-between items-center">
                                        <span class="font-semibold">Estado de la Reserva:</span>
                                        {{ ucfirst($reservation->status) }}

                                        <!-- Formulario para cancelar la reserva -->
                                        <form id="deleteForm-{{ $reservation->id }}"
                                            action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="button"
                                                onclick="confirmarEliminacion('deleteForm-{{ $reservation->id }}')"
                                                class="w-20 h-10 rounded-full bg-red-500 text-white hover:bg-red-600 focus:outline-none">
                                                Cancelar
                                            </button>
                                        </form>
                                    </div>

                                    <div class="text-sm text-gray-500 mb-4">
                                        <span class="font-semibold">Ubicación: </span>
                                        <span>{{ $reservation->event->location }}</span>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="block p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200">
                                    <h5 class="text-2xl font-semibold mb-2 text-gray-800">ESTE EVENTO HA SIDO ELIMINADO</h5>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endsection
</x-app-layout>
@include('layouts.partials.footer')
