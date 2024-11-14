<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CordiSimple</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-gradient-to-r from-[#021b79] to-[#021b50]">
        @include('layouts.partials.navbar')
    </header>

    <main class="flex-grow ">
        <section class="relative h-[100vh]">
            <img src="{{ asset('banner.jpeg') }}" alt="Banner Hero" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center text-gray-200 z-10">
                <div>
                    <h1 class="mb-4 text-7xl font-bold">Welcome to <span
                            class="bg-gradient-to-r from-pink-600 via-red-500 to-pink-600 text-transparent bg-clip-text">CordiSimple</span>
                    </h1>
                    <p class="text-2xl mb-8">Effortlessly manage your events with our powerful platform</p>
                    @if (!Auth::check())
                        <a href="{{ route('register') }}"
                            class="inline-flex h-12 animate-shimmer items-center justify-center rounded-md border border-[#0575e6] bg-[linear-gradient(110deg,#0575e6,45%,#021b79,55%,#0575e6)] bg-[length:200%_100%] px-6 font-medium text-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-[#021b79] focus:ring-offset-2 focus:ring-offset-slate-50">Get
                            Started</a>
                    @endif
                </div>
            </div>
        </section>

        <div class="py-8 flex flex-wrap justify-center gap-4" style="background: radial-gradient(circle, rgb(19, 45, 94), rgba(0, 0, 0, 1)); ">
            <h2 class="text-5xl font-bold bg-gradient-to-r from-red-600 via-red-500 to-red-600 text-transparent bg-clip-text mb-8 text-center">Events near to you</h2>
            <x-event-cards :events="$events" />

            <section class="py-8">
                <div class="container mx-auto text-center">
                    <h2
                        class="text-5xl font-bold bg-gradient-to-r from-red-600 via-red-500 to-red-600 text-transparent bg-clip-text mb-8">
                        Why CordiSimple?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                            <h3 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-white">Easy to Use</h3>
                            <p class="text-gray-600 dark:text-gray-400">Our intuitive interface makes event management a
                                breeze.</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                            <h3 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-white">Powerful Features</h3>
                            <p class="text-gray-600 dark:text-gray-400">Streamline your event planning with our robust
                                set
                                of tools.</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                            <h3 class="text-2xl font-semibold mb-2 text-gray-800 dark:text-white">Reliable Support</h3>
                            <p class="text-gray-600 dark:text-gray-400">Our dedicated team is here to help you every
                                step of
                                the way.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        </div>
    </main>
    @include('layouts.partials.footer')
</body>

</html>
