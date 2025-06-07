@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

    {{-- Título --}}
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        Editar Perfil de {{ $user->name }}
    </h2>

    {{-- Mensaje de éxito --}}
    @if(session('status'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    {{-- Formulario de Edición --}}
    <div class="bg-white shadow sm:rounded-lg p-6">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            {{-- Nombre --}}
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-1">Nombre</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required
                >
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Fecha de registro (solo lectura) --}}
            <div class="mb-6">
                <label for="created_at" class="block text-gray-700 font-semibold mb-1">Registrado desde</label>
                <input
                    type="text"
                    id="created_at"
                    name="created_at"
                    value="{{ $user->created_at->format('d/m/Y') }}"
                    class="w-full border-gray-300 rounded-md bg-gray-100 cursor-not-allowed"
                    disabled
                >
            </div>

            {{-- Cambiar contraseña --}}
            <h3 class="text-lg font-semibold mb-4 border-t pt-4">Cambiar Contraseña (opcional)</h3>

            <div class="mb-4">
                <label for="current_password" class="block text-gray-700 font-semibold mb-1">Contraseña actual</label>
                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    autocomplete="current-password"
                >
                @error('current_password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-1">Nueva contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    autocomplete="new-password"
                >
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-1">Confirmar nueva contraseña</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    autocomplete="new-password"
                >
            </div>

            {{-- Botones --}}
            <div class="flex space-x-4">
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Guardar Cambios
                </button>

                <a href="{{ route('profile.index') }}" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
