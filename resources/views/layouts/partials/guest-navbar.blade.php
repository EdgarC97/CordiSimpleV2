@vite(['resources/css/app.css', 'resources/js/app.js'])

<nav class="container mx-auto flex justify-between items-center h-16 bg-gradient-to-r from-[#021b79] to-[#021b50]">
    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-gray-500 dark:text-gray-200">CordiSimple</a>
    <div>
        <a href="{{ route('register') }}"
            class="text-gray-200 font-bold  hover:text-gray-500 dark:hover:text-white mr-4 transition">Register</a>
        <a href="{{ route('login') }}"
            class="text-gray-200 font-bold  hover:text-gray-500 dark:hover:text-white transition">Login</a>
    </div>
</nav>
