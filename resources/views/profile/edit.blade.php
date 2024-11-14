<x-app-layout>
    @section('title', 'Edit Profile')

    @section('content')
        <main class="flex justify-center  dark:bg-gray-900">
            <!-- Session Status -->
            @if (session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <form action="{{ route('profile.update', Auth::id()) }}" method="POST"
                class="w-full max-w-sm p-4 bg-gray-900 text-white border border-gray-200 rounded-lg shadow space-y-6 ">
                @csrf
                @method('PUT')

                <!-- Title -->
                <h1 class="text-lg font-bold text-white ">{{ __('Edit Profile') }}</h1>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-white text-left">{{ __('Name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus
                        autocomplete="name"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black" />
                    @error('name')
                        <div class="text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-white text-left">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                        autocomplete="email"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black" />
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-white text-left">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" autocomplete="new-password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black" />
                    <small class="text-gray-500 dark:text-gray-400">{{ __('Leave blank to keep the current password.') }}</small>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-white text-left">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 text-black" />
                </div>

                <!-- Update Button -->
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{ __('Update Profile') }}
                </button>

                <!-- Cancel Button -->
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300 mt-2">
                    <a href="{{ route('dashboard') }}"
                        class="w-full block text-center text-white bg-red-500 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </main>
    @endsection
</x-app-layout>

@include('layouts.partials.footer')
