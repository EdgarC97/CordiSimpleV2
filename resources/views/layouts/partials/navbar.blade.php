@vite(['resources/css/app.css', 'resources/js/app.js'])

@auth
    @include('layouts.partials.app-navbar')
@else
    @include('layouts.partials.guest-navbar')
@endauth