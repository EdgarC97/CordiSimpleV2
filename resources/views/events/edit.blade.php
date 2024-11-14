<x-app-layout>
    @section('title', 'Editar el evento')
@section('content')
    <div class="container mx-auto py-8 ">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <form action="{{ route('events.update', $event->id) }}" method="POST" class="px-8 py-8">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre del evento:</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('name', $event->name) }}" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Descripción:</label>
                    <textarea name="description" id="description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        rows="4">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="date" class="block text-gray-700 font-bold mb-2">Día:</label>
                    <input type="date" name="date" id="date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('date', $event->date) }}">
                    @error('date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="time" class="block text-gray-700 font-bold mb-2">Hora:</label>
                    <input type="time" name="time" id="time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('time', $event->time) }}">
                    @error('time')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="location" class="block text-gray-700 font-bold mb-2">Lugar:</label>
                    <input type="text" name="location" id="location"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('location', $event->location) }}">
                    @error('location')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="max_capacity" class="block text-gray-700 font-bold mb-2">Capacidad máxima:</label>
                    <input type="number" name="max_capacity" id="max_capacity"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('max_capacity', $event->max_capacity) }}">
                    @error('max_capacity')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="availableSpots" class="block text-gray-700 font-bold mb-2">Lugares disponibles:</label>
                    <input type="number" name="availableSpots" id="availableSpots"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('availableSpots', $event->availableSpots) }}">
                    @error('availableSpots')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-gray-700 font-bold mb-2">Status:</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                        <option value="Activo" {{ old('status', $event->status) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Pospuesto" {{ old('status', $event->status) == 'Pospuesto' ? 'selected' : '' }}>Pospuesto</option>
                        <option value="Cancelado" {{ old('status', $event->status) == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('events.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancelar</a>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Actualizar evento</button>
                </div>
            </form>
        </div>
    </div>
@endsection
</x-app-layout>
@include('layouts.partials.footer')
