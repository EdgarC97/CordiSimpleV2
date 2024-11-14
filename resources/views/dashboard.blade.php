<x-app-layout>
    @section('content') 
        <div class="flex flex-wrap justify-center gap-4">
            <x-event-cards :events="$events" />
        </div>
    @endsection
</x-app-layout>

@include('layouts.partials.footer')
