<x-app-layout>
    @section('title', 'Lista de Usuarios')

    @section('content')
        <div class="container mx-auto py-8 px-4 min-h-screen" >

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla de usuarios -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm">
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Rol</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="{{ $user->role === 'admin' ? 'bg-yellow-200' : 'bg-blue-200' }} text-gray-700 border-b">
                                <td class="px-4 py-3">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">{{ $user->role }}</td>
                                <td class="px-4 py-3 flex space-x-2 justify-around">
                                    <!-- Show Button -->
                                    <a href="{{ route('users.show', $user->id) }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                                        Ver Detalles
                                    </a>
                                    

                                    <!-- Change Role Button -->
                                    <form action="{{ route('users.role', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="role" value="{{ $user->role === 'admin' ? 'user' : 'admin' }}">
                                        <button type="submit" class="text-white font-semibold py-2 px-4 rounded {{ $user->role === 'admin' ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-blue-500 hover:bg-blue-600' }}">
                                            Cambiar a {{ $user->role === 'admin' ? 'Usuario' : 'Admin' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
</x-app-layout>
@include('layouts.partials.footer')