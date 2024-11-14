<x-app-layout>
@section('title','Create a new event')
@section('content')
    <div class="container mx-auto py-8">     
        <!-- Verifica si hay errores de validación -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 border border-red-400 rounded-md p-4 mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <form action="{{ route('events.store') }}" method="POST" class="px-8 py-8">
                @csrf
                @method('POST')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre del evento:</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('nombre') }}" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Descripcion:</label>
                    <textarea name="description" id="description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="date" class="block text-gray-700 font-bold mb-2">Dia:</label>
                    <input type="date" name="date" id="date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        rows="4">{{ old('date') }}
                    @error('date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="time" class="block text-gray-700 font-bold mb-2">Hora:</label>
                    <input type="time" name="time" id="time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        value="{{ old('time') }}">
                    @error('time')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                

                <div class="mb-6">
                    <label for="location" class="block text-gray-700 font-bold mb-2">Lugar:</label>
                    <input type="text" name="location" id="location"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        rows="4">{{ old('location') }}
                    @error('location')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="max_capacity" class="block text-gray-700 font-bold mb-2">Capacidad maxima:</label>
                    <input type="number" name="max_capacity" id="max_capacity"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        rows="4">{{ old('max_capacity') }}
                    @error('max_capacity')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="availableSpots" class="block text-gray-700 font-bold mb-2">Lugares disponibles:</label>
                    <input type="number" name="availableSpots" id="availableSpots"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        rows="4">{{ old('availableSpots') }}
                    @error('availableSpots')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="image_url" class="block text-gray-700 font-bold mb-2">Url de imagen:</label>
                    <input type="text" name="image_url" id="image_url"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        rows="4">{{ old('image_url') }}
                    @error('image_url')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-gray-700 font-bold mb-2">Status:</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                        rows="4">{{ old('status') }}
                        <option value="Activo">Activo</option>
                        <option value="Pospuesto">Pospuesto</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                    @error('status')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('events.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Cancelar</a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crear</button>
                </div>
            </form>
        </div>
    </div>
@endsection
</x-app-layout>

@include('layouts.partials.footer')