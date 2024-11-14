@if ($events->isEmpty())
    <p class="text-center text-gray-600">No hay eventos disponibles.</p>
@else
    <div class="py-8">
        <div class="flex flex-wrap justify-center gap-4">
            @foreach ($events as $event)
                <div class="max-w-sm bg-gradient-to-r from-[#141E30] to-[#243B55] rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 duration-300">
                    <a href="#">
                        <img class="rounded-t-lg w-full h-48 object-cover" src="{{ $event->image_url }}" alt="{{ $event->name }}" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $event->name }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $event->description }}</p>
                        <a href="{{ auth()->check() ? route('events.usershow', $event->id) : route('register') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ver más</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
