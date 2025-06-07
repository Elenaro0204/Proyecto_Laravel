@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-10 bg-white rounded-2xl shadow-2xl border border-gray-100">
    <h1 class="text-4xl font-extrabold text-indigo-700 mb-12 text-center tracking-tight drop-shadow-sm">
        Crear nuevo viaje
    </h1>

    @if ($errors->any())
        <div class="mb-8 rounded-lg bg-red-50 border border-red-400 p-5 text-red-700 shadow-sm animate-fadeIn">
            <ul class="list-disc list-inside space-y-1 text-sm font-semibold">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('viajes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf

        <div>
            <label for="titulo" class="block text-sm font-semibold text-gray-800 mb-3">Título</label>
            <input
                id="titulo"
                name="titulo"
                type="text"
                value="{{ old('titulo') }}"
                required
                autofocus
                placeholder="Ej. Vacaciones en la playa"
                class="w-full rounded-xl border border-gray-300 px-5 py-3 text-gray-900 placeholder-gray-400 shadow-md
                       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition duration-300"
            />
            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-semibold text-gray-800 mb-3">Descripción</label>
            <textarea
                id="descripcion"
                name="descripcion"
                rows="6"
                required
                placeholder="Descripción detallada del viaje"
                class="w-full rounded-xl border border-gray-300 px-5 py-4 text-gray-900 placeholder-gray-400 shadow-md
                       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition duration-300 resize-none"
            >{{ old('descripcion') }}</textarea>
            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
        </div>

        <div>
            <label for="destino_id" class="block text-sm font-semibold text-gray-800 mb-3">Destino</label>
            <select
                id="destino_id"
                name="destino_id"
                required
                class="w-full rounded-xl border border-gray-300 px-5 py-3 text-gray-900 shadow-md
                       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition duration-300"
            >
                <option value="" disabled {{ old('destino_id') ? '' : 'selected' }}>📍 Selecciona un destino</option>
                @foreach($destinos as $destino)
                    <option value="{{ $destino->id }}" {{ old('destino_id') == $destino->id ? 'selected' : '' }}>
                        📍 {{ $destino->nombre }} - {{ $destino->pais }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('destino_id')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
                <label for="fecha_inicio" class="block text-sm font-semibold text-gray-800 mb-3">Fecha de inicio</label>
                <input
                    type="date"
                    name="fecha_inicio"
                    id="fecha_inicio"
                    value="{{ old('fecha_inicio', $viaje->fecha_inicio ?? '') }}"
                    required
                    class="w-full rounded-xl border border-gray-300 px-5 py-3 text-gray-900 shadow-md
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition duration-300"
                />
            </div>

            <div>
                <label for="fecha_fin" class="block text-sm font-semibold text-gray-800 mb-3">Fecha de fin</label>
                <input
                    type="date"
                    name="fecha_fin"
                    id="fecha_fin"
                    value="{{ old('fecha_fin', $viaje->fecha_fin ?? '') }}"
                    required
                    class="w-full rounded-xl border border-gray-300 px-5 py-3 text-gray-900 shadow-md
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition duration-300"
                />
            </div>
        </div>

        <div>
            <label for="foto" class="block text-sm font-semibold text-gray-800 mb-3">Foto (opcional)</label>
            <input
                id="foto"
                name="foto"
                type="file"
                accept="image/*"
                class="w-full text-gray-700
                       file:mr-5 file:py-2 file:px-5
                       file:rounded-full file:border-0
                       file:text-sm file:font-semibold
                       file:bg-indigo-100 file:text-indigo-700
                       hover:file:bg-indigo-200
                       cursor-pointer
                       transition duration-300"
            />
            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
        </div>

        <div class="flex justify-end gap-6">
            <a href="{{ route('viajes.index') }}"
               class="inline-flex items-center px-8 py-3 bg-gray-200 rounded-xl text-gray-700 font-semibold
                      hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition duration-300"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="inline-flex items-center px-8 py-3 bg-indigo-600 rounded-xl text-white font-semibold
                       hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300"
            >
                Guardar viaje
            </button>
        </div>
    </form>
</div>
@endsection
