<x-guest-layout>
    <div
        class="w-full sm:max-w-lg mt-6 px-8 py-6 bg-white bg-opacity-30 border-2 border-red-500 shadow-md overflow-hidden sm:rounded-lg">

        <!-- Cabecera con logo -->
        <div class="mb-6 text-center">
            <h2 class="mt-3 text-3xl font-bold">
                <span class="text-white">Login</span>
            </h2>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />



        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Formulario con estilos personalizados -->
        <form method="POST" action="{{ route('login') }}" class="bg-gray-800 bg-opacity-80 p-6 rounded-lg shadow-xl">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-white" />

                <x-text-input id="password" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white"
                    type="password" name="password" required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded bg-gray-700 border-gray-600 text-red-500 focus:ring-red-500 focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                <!-- Enlaces de ayuda -->
                <div>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 focus:ring-offset-gray-800"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Botón Login -->
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>

        <!-- Enlace para registrarse -->
        <div class="text-center mt-6">
            <p class="text-white">
                {{ __('Don\'t have an account?') }}
                <a href="{{ route('register') }}" class="text-red-400 hover:text-red-300 font-semibold">
                    {{ __('Register here') }}
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
