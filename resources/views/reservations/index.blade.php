<x-app-layout>
    @section('title', 'Todas las reservas')
    @section('content')
        <div class="container mx-auto py-8 min-h-screen">
            @if ($reservations->isEmpty())
                <p class="text-center text-gray-500">No hay eventos reservados.</p>
            @else
                <div class="flex flex-wrap -mx-4">

                    @php
                        // Separamos las reservas "Agendada" y las demás
                        [$agendadas, $otras] = $reservations->partition(
                            fn($reservation) => $reservation->status === 'Agendada',
                        );
                    @endphp

                    <div class="mb-6 p-4 bg-green-100 rounded-lg shadow-md w-full">
                        <h2 class="text-2xl font-semibold text-green-800 mb-4">Reservas Agendadas</h2>
                        <div class="flex flex-wrap">
                            @foreach ($agendadas as $reservation)
                                <div
                                    class="block p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 mb-4 mx-4 w-full sm:w-1/2 lg:w-1/3">
                                    <h5 class="text-2xl font-semibold mb-2 text-gray-800">{{ $reservation->user->name }}</h5>
                                    <h5 class="text-2xl font-semibold mb-2 text-gray-800">{{ $reservation->event->name }}
                                    </h5>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($reservation->event->description, 100) }}
                                    </p>
                                    <div class="text-sm text-gray-500 mb-2">
                                        <span class="font-semibold">Fecha:</span>
                                        {{ \Carbon\Carbon::parse($reservation->event->date)->format('d-m-Y') }} |
                                        <span class="font-semibold">Hora:</span>
                                        {{ \Carbon\Carbon::parse($reservation->event->time)->format('H:i') }}
                                    </div>
                                    <div class="text-sm text-gray-500 mb-2 flex justify-between items-center">
                                        <span class="font-semibold">Estado de la Reserva:</span>
                                        {{ ucfirst($reservation->status) }}
                                        <!-- Formulario para eliminar la reserva -->
                                        <form id="deleteForm-{{ $reservation->id }}" action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                            @csrf
                                            <button type="button" onclick="confirmarEliminacion('deleteForm-{{ $reservation->id }}')"
                                                class="w-20 h-10 rounded-full bg-red-500 text-white hover:bg-red-600 focus:outline-none">
                                                <span class="material-icons">Eliminar</span>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="text-sm text-gray-500 mb-4">
                                        <span class="font-semibold">Ubicación: </span>
                                        <span>{{ $reservation->event->location }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6 p-4 bg-red-100 rounded-lg shadow-md w-full">
                        <h2 class="text-2xl font-semibold text-red-800 mb-4">Reservas Canceladas</h2>
                        <div class="flex flex-wrap">
                            @foreach ($otras as $reservation)
                                <div
                                    class="block p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 mb-4 mx-4 w-full sm:w-1/2 lg:w-1/3">
                                    <h5 class="text-2xl font-semibold mb-2 text-gray-800">{{ $reservation->user->name }}
                                    </h5>
                                    <h5 class="text-2xl font-semibold mb-2 text-gray-800">{{ $reservation->event->name }}
                                    </h5>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($reservation->event->description, 100) }}
                                    </p>
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
                                        <form id="deleteForm-{{ $reservation->id }}" action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                            @csrf
                                            <button type="button" onclick="confirmarEliminacion('deleteForm-{{ $reservation->id }}')"
                                                class="w-20 h-10 rounded-full bg-red-500 text-white hover:bg-red-600 focus:outline-none">
                                                <span class="material-icons">Eliminar</span>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="text-sm text-gray-500 mb-4">
                                        <span class="font-semibold">Ubicación: </span>
                                        <span>{{ $reservation->event->location }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endsection
</x-app-layout>
@include('layouts.partials.footer')
