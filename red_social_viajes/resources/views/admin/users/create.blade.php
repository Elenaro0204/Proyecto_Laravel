@extends('layouts.app')

@section('content')
<div class="container max-w-md mx-auto py-8 px-6 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Crear Usuario</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" novalidate>
        @csrf

        {{-- Nombre --}}
        <div class="mb-5">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            @error('name')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-5">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            @error('email')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Administrador --}}
        <div class="mb-5">
            <label for="is_admin" class="inline-flex items-center space-x-2">
                <input type="checkbox" id="is_admin" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}
                    class="form-checkbox h-5 w-5 text-green-600">
                <span class="text-gray-700 font-semibold">Administrador</span>
            </label>
        </div>

        {{-- Contraseña --}}
        <div class="mb-5">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
            <input type="password" id="password" name="password"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            @error('password')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirmar Contraseña --}}
        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
        </div>

        {{-- Botones --}}
        <div class="flex space-x-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md transition">
                Crear
            </button>

            <a href="{{ route('admin.users.index') }}" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 rounded-md font-semibold text-gray-800">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
