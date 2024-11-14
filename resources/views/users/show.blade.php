<x-app-layout>
@section('title', 'Detalles del Usuario')

@section('content')
    <div class="container mx-auto py-8 px-4 min-h-screen">

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Información del Usuario</h2>
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Rol:</strong> {{ $user->role }}</p>
            <p><strong>Fecha de Creación:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
            <p><strong>Última Actualización:</strong> {{ $user->updated_at->format('d/m/Y') }}</p>
        </div>

        <h2 class="text-xl font-semibold mt-8 mb-4">Reservas del Usuario</h2>

        @if($user->reservations->isEmpty())
            <p class="text-center text-gray-600">No hay reservas disponibles para este usuario.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm">
                        <tr>
                            <th class="px-4 py-2">Evento</th>
                            <th class="px-4 py-2">Fecha</th>
                            <th class="px-4 py-2">Hora</th>
                            <th class="px-4 py-2">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->reservations as $reservation)
                            <tr class="text-gray-700 border-b hover:bg-gray-100">
                                <td class="px-4 py-3">{{ $reservation->event->name }}</td>
                                <td class="px-4 py-3">{{ $reservation->event->date }}</td>
                                <td class="px-4 py-3">{{ $reservation->event->time }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($reservation->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($reservation->status == 'canceled') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Botón para volver a la lista de usuarios -->
        <div class="mt-8 text-center">
            <a href="{{ route('users.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                Volver a la Lista de Usuarios
            </a>
        </div>
    </div>
@endsection
</x-app-layout>
@include('layouts.partials.footer')