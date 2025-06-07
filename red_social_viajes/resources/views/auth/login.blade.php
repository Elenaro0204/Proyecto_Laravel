<x-guest-layout>
    <div class="max-w-md w-full bg-white bg-opacity-90 rounded-3xl shadow-2xl p-10 space-y-8">
        <div class="text-center">
            {{-- Icono de avión (puedes cambiarlo por otro SVG si quieres) --}}
            <svg class="mx-auto h-14 w-14 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 3v3m0 0L3 9l7.5-3zm0 0L21 14l-7.5-3zM3 21h18" />
            </svg>
            <h2 class="mt-4 text-3xl font-extrabold text-gray-900">
                Bienvenido a GoTogether
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Conéctate y comparte tus aventuras.
            </p>
            <p class="mt-1 text-sm text-indigo-700 font-semibold">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="underline hover:text-indigo-900">
                    Regístrate aquí
                </a>
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:border-indigo-600 focus:ring-indigo-600 focus:ring-1 transition" placeholder="ejemplo@correo.com">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:border-indigo-600 focus:ring-indigo-600 focus:ring-1 transition" placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-gray-700">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 select-none">Recuérdame</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <div>
                <button type="submit"
                    class="w-full flex justify-center py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-semibold rounded-xl shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
