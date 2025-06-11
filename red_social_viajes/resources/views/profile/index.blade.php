@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-10 space-y-10">

    {{-- Título y Avatar --}}
    <div class="flex flex-col items-center gap-4">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4f46e5&color=fff&size=128"
             alt="Avatar de {{ $user->name }}"
             class="w-32 h-32 rounded-full shadow-lg border-4 border-white" />
        <h2 class="text-4xl font-extrabold text-indigo-800 tracking-tight text-center">
            Perfil de <span class="text-indigo-950">{{ $user->name }}</span>
        </h2>
    </div>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded shadow" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Información del Usuario --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-indigo-700 border-b pb-2 mb-4">Información personal</h3>
            <ul class="text-gray-700 space-y-2">
                <li><strong>Nombre:</strong> {{ $user->name }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Registrado desde:</strong> {{ $user->created_at->format('d/m/Y') }}</li>
                @if($user->telefono)
                    <li><strong>Teléfono:</strong> {{ $user->telefono }}</li>
                @endif
                @if($user->direccion)
                    <li><strong>Dirección:</strong> {{ $user->direccion }}</li>
                @endif
                @if($user->fecha_nacimiento)
                    <li><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($user->fecha_nacimiento)->format('d/m/Y') }}</li>
                @endif
            </ul>

            <div class="flex justify-end mt-6 gap-4">
                <a href="{{ route('profile.edit') }}"
                    class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
                    Editar Perfil
                </a>
                <button onclick="document.getElementById('change-password-section').classList.toggle('hidden')"
                    class="px-5 py-2 bg-gray-300 text-gray-800 font-semibold rounded hover:bg-gray-400 transition">
                    Cambiar contraseña
                </button>
            </div>
        </div>

        {{-- Sobre mí y estadísticas --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
            <h3 class="text-xl font-semibold text-indigo-700 border-b pb-2 mb-4">Sobre mí</h3>
            <p class="text-gray-600 leading-relaxed mb-6">
                Hola, soy {{ $user->name }}, amante de los viajes, la cultura y los nuevos destinos. Me encanta compartir mis experiencias y descubrir rincones escondidos de España y del mundo.
            </p>

            <div class="grid grid-cols-2 gap-4 text-center text-indigo-700 font-semibold">
                <div class="bg-indigo-100 rounded-xl p-4">
                    <p class="text-3xl">{{ $viajes->count() }}</p>
                    <p class="text-sm text-indigo-900">Viajes publicados</p>
                </div>
                <div class="bg-indigo-100 rounded-xl p-4">
                    <p class="text-3xl">4.7★</p>
                    <p class="text-sm text-indigo-900">Valoración media</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Cambiar Contraseña --}}
    <div id="change-password-section" class="bg-white shadow-md rounded-xl p-6 border border-gray-200 hidden">
        <h3 class="text-xl font-semibold text-indigo-700 border-b pb-2 mb-4">Cambiar contraseña</h3>
        <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block font-semibold mb-2 text-sm">Contraseña actual</label>
                <input type="password" name="current_password" id="current_password" required
                       class="w-full border px-4 py-3 rounded shadow-sm focus:ring-2 focus:ring-indigo-500">
                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="block font-semibold mb-2 text-sm">Nueva contraseña</label>
                <input type="password" name="password" id="password" required
                       class="w-full border px-4 py-3 rounded shadow-sm focus:ring-2 focus:ring-indigo-500">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="block font-semibold mb-2 text-sm">Confirmar nueva contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full border px-4 py-3 rounded shadow-sm focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="text-right">
                <button type="submit"
                        class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded hover:bg-indigo-700 transition">
                    Actualizar contraseña
                </button>
            </div>
        </form>
    </div>

    {{-- Publicaciones de viajes --}}
    <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
        <h3 class="text-xl font-semibold text-indigo-700 border-b pb-2 mb-4">Mis Publicaciones de Viajes</h3>

        @if(isset($viajes) && $viajes->count())
            <div class="grid gap-4 md:grid-cols-2">
                @foreach($viajes as $viaje)
                    <div class="border rounded-xl p-4 shadow hover:shadow-md transition bg-indigo-50">
                        <h4 class="text-lg font-semibold text-indigo-800">{{ $viaje->titulo }}</h4>
                        <p class="text-sm text-gray-600 italic">
                            {{ $viaje->fecha_inicio?->format('d/m/Y') ?? 'Sin fecha' }}
                            al
                            {{ $viaje->fecha_fin?->format('d/m/Y') ?? 'Sin fecha' }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 italic">No tienes viajes publicados aún.</p>
        @endif
    </div>
</div>
@endsection
