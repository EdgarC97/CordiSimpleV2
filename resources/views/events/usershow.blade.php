<x-app-layout>

    @section('title', 'Detalles del Evento')

    @section('content')
        <div class="container mx-auto py-8 px-4 min-h-screen">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-3xl font-bold text-center mb-6">{{ $event->name }}</h1>

                <!-- Detalles del evento -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Descripción</h2>
                        <p class="text-gray-600">{{ $event->description }}</p>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Ubicación</h2>
                        <p class="text-gray-600">{{ $event->location }}</p>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Fecha y Hora</h2>
                        <p class="text-gray-600">{{ $event->date }} a las {{ $event->time }}</p>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Capacidad Máxima</h2>
                        <p class="text-gray-600">{{ $event->max_capacity }}</p>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Lugares Disponibles</h2>
                        <p class="text-gray-600">{{ $event->availableSpots }}</p>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Estado</h2>
                        <span
                            class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                        @if ($event->status == 'Activo') bg-green-100 text-green-800
                        @elseif($event->status == 'Cancelado') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                            {{ $event->status }}
                        </span>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex space-x-4 mt-6 justify-center">
                    <a href="{{ route('reservations.schedule', $event->id) }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow">
                        Agendar evento
                    </a>
                </div>

                <!-- Regresar a la lista de eventos -->
                <div class="mt-8 text-center">
                    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                        Volver a la Lista de Eventos
                    </a>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
@include('layouts.partials.footer')
