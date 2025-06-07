@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8 py-8">

    {{-- Título --}}
    <h2 class="font-extrabold text-4xl text-indigo-700 tracking-wide text-center">
        Perfil de <span class="text-indigo-900">{{ $user->name }}</span>
    </h2>

    @if (session('status'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
        {{ session('status') }}
    </div>
@endif

    {{-- Info Usuario --}}
    <div class="bg-white shadow-md rounded-xl p-8 border border-gray-200">
        <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b pb-2">Información del Usuario</h3>
        <div class="space-y-4 text-gray-700 text-base leading-relaxed">
            <p><span class="font-semibold text-gray-900">Nombre:</span> {{ $user->name }}</p>
            <p><span class="font-semibold text-gray-900">Email:</span> {{ $user->email }}</p>
            <p><span class="font-semibold text-gray-900">Registrado desde:</span> {{ $user->created_at->format('d/m/Y') }}</p>
            {{-- Más información opcional --}}
            @if($user->telefono ?? false)
                <p><span class="font-semibold text-gray-900">Teléfono:</span> {{ $user->telefono }}</p>
            @endif
            @if($user->direccion ?? false)
                <p><span class="font-semibold text-gray-900">Dirección:</span> {{ $user->direccion }}</p>
            @endif
            @if($user->fecha_nacimiento ?? false)
                <p><span class="font-semibold text-gray-900">Fecha de nacimiento:</span> {{ \Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y') }}</p>
            @endif
        </div>
        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('profile.edit') }}"
                class="inline-block px-7 py-3 bg-indigo-600 text-white rounded-lg font-semibold shadow-md
                       hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
            >
                Editar Perfil
            </a>
            <button
                type="button"
                onclick="document.getElementById('change-password-section').classList.toggle('hidden')"
                class="inline-block px-7 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold shadow-md
                       hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition"
            >
                Cambiar contraseña
            </button>
        </div>
    </div>

    {{-- Cambiar Contraseña --}}
    <div id="change-password-section" class="bg-white shadow-md rounded-xl p-8 border border-gray-200 hidden">
        <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b pb-2">Cambiar contraseña</h3>
        <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Contraseña actual</label>
                <input
                    id="current_password"
                    name="current_password"
                    type="password"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-800 placeholder-gray-400 shadow-sm
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                />
                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Nueva contraseña</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-800 placeholder-gray-400 shadow-sm
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirmar nueva contraseña</label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-800 placeholder-gray-400 shadow-sm
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                />
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    class="inline-flex items-center px-7 py-3 bg-indigo-600 rounded-lg text-white font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                >
                    Actualizar contraseña
                </button>
            </div>
        </form>
    </div>

    {{-- Viajes del usuario --}}
    <div class="bg-white shadow-md rounded-xl p-8 border border-gray-200">
        <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b pb-2">Mis Publicaciones de Viajes</h3>

        @if(isset($viajes) && $viajes->count())
            <ul class="list-disc list-inside space-y-3 text-gray-700 text-base">
                @foreach($viajes as $viaje)
                    <li class="hover:text-indigo-600 transition cursor-default">
                        <span class="font-semibold">{{ $viaje->titulo }}</span> -
                        <span class="italic text-gray-500">{{ $viaje->fecha_inicio?->format('d/m/Y') ?? 'Sin fecha' }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 italic">No tienes viajes publicados.</p>
        @endif
    </div>

</div>
@endsection
