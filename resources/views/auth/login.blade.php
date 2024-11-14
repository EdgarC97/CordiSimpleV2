<header class="bg-gradient-to-r from-[#021b79] to-[#021b50]">
    @include('layouts.partials.navbar')
</header>
<x-guest-layout >
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">{{ __('Sign in to our platform') }}</h5>
            
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Your email')" />
                <x-text-input id="email" 
                             type="email" 
                             name="email" 
                             :value="old('email')" 
                             placeholder="name@company.com"
                             required 
                             autofocus 
                             autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Your password')" />
                <x-text-input id="password"
                             type="password"
                             name="password"
                             placeholder="••••••••"
                             required
                             autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="flex items-start">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" 
                               type="checkbox"
                               name="remember"
                               class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" />
                    </div>
                    <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        {{ __('Remember me') }}
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="ms-auto text-sm text-blue-700 hover:underline dark:text-blue-500">
                        {{ __('Lost Password?') }}
                    </a>
                @endif
            </div>

            <x-primary-button>
                {{ __('Login to your account') }}
            </x-primary-button>

            <!-- Register Link -->
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                {{ __('Not registered?') }}
                <a href="{{ route('register') }}" class="text-blue-700 hover:underline dark:text-blue-500">
                    {{ __('Create account') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>