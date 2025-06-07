@extends('layouts.app')

@section('content')
<div class="container max-w-lg mx-auto py-8 px-4 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Usuario</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div class="mb-5">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            @error('name')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-5">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            @error('email')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Rol de administrador --}}
        <div class="mb-5">
            <label for="is_admin" class="inline-flex items-center space-x-2">
                <input type="checkbox" id="is_admin" name="is_admin" value="1"
                    {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                    class="form-checkbox h-5 w-5 text-indigo-600">
                <span class="text-gray-700 font-semibold">Administrador</span>
            </label>
        </div>

        {{-- Nueva contraseña --}}
        <div class="mb-5">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Nueva Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Dejar vacío para no cambiar"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('password')
                <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirmar nueva contraseña --}}
        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmar Nueva Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite la nueva contraseña"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        {{-- Botones --}}
        <div class="flex space-x-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-md transition">
                Actualizar
            </button>

            <a href="{{ route('admin.users.index') }}" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 rounded-md font-semibold text-gray-800">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
