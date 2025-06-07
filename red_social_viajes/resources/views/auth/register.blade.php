<x-guest-layout>
    <div class="max-w-md w-full bg-white bg-opacity-90 rounded-3xl shadow-2xl p-10 space-y-8">
        <div class="text-center">
            {{-- Icono de globo terráqueo (viajes) --}}
            <img src="{{ asset('assets/avion.png') }}" alt="Icono web" class="mx-auto block w-20 h-auto rounded mb-3">

            <h2 class="mt-4 text-3xl font-extrabold text-gray-900">
                Crea tu cuenta en GoTogether
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Únete y comienza a compartir tus aventuras de viaje.
            </p>
            <p class="mt-1 text-sm text-indigo-700 font-semibold">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="underline hover:text-indigo-900">
                    Inicia sesión aquí
                </a>
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:border-indigo-600 focus:ring-indigo-600 focus:ring-1 transition" placeholder="Tu nombre completo">
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:border-indigo-600 focus:ring-indigo-600 focus:ring-1 transition" placeholder="ejemplo@correo.com">
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="password" name="password" type="password" required autocomplete="new-password"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:border-indigo-600 focus:ring-indigo-600 focus:ring-1 transition" placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                    class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:border-indigo-600 focus:ring-indigo-600 focus:ring-1 transition" placeholder="••••••••">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-600" />
            </div>

            <div class="flex items-center justify-end">
                <button type="submit"
                    class="w-full flex justify-center py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-semibold rounded-xl shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition">
                    Registrarse
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
