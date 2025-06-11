@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6 sm:px-8 lg:px-1">

    {{-- Título --}}
    <h1 class="text-3xl font-extrabold text-indigo-700 mb-8 text-center">
        Editar Perfil de {{ $user->name }}
    </h1>

    {{-- Mensaje de éxito --}}
    @if(session('status'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-300">
            {{ session('status') }}
        </div>
    @endif

    {{-- Formulario --}}
    <div class="bg-white shadow-lg rounded-xl p-8 space-y-8">

        {{-- Datos personales --}}
        <div>
            <h3 class="text-xl font-semibold text-indigo-700 border-b pb-2 mb-4">Información Personal</h3>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                {{-- Nombre --}}
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-1">Nombre</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required
                    >
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required
                    >
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Fecha de registro --}}
                <div class="mb-6">
                    <label for="created_at" class="block text-gray-700 font-medium mb-1">Registrado desde</label>
                    <input
                        type="text"
                        id="created_at"
                        name="created_at"
                        value="{{ $user->created_at->format('d/m/Y') }}"
                        class="w-full px-4 py-2 border border-gray-200 bg-gray-100 rounded-lg cursor-not-allowed"
                        disabled
                    >
                </div>

                <hr class="my-6 border-gray-300">

                {{-- Cambiar contraseña --}}
                <h3 class="text-xl font-semibold text-indigo-700 mb-4">Cambiar Contraseña <span class="text-sm font-normal text-gray-500">(opcional)</span></h3>

                <div class="mb-4">
                    <label for="current_password" class="block text-gray-700 font-medium mb-1">Contraseña actual</label>
                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        autocomplete="current-password"
                    >
                    @error('current_password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-1">Nueva contraseña</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        autocomplete="new-password"
                    >
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirmar nueva contraseña</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        autocomplete="new-password"
                    >
                </div>

                {{-- Botones --}}
                <div class="flex items-center justify-end gap-4 mt-8">
                    <a href="{{ route('profile.index') }}"
                       class="px-5 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
