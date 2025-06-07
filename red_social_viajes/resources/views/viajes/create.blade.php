@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Crear nuevo viaje</h1>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('viajes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="titulo" :value="__('Título')" />
            <x-text-input id="titulo" name="titulo" type="text" class="mt-1 block w-full" :value="old('titulo')" required autofocus />
            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="descripcion" :value="__('Descripción')" />
            <textarea id="descripcion" name="descripcion" rows="4" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('descripcion') }}</textarea>
            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="destino_id" :value="__('Destino')" />
            <select id="destino_id" name="destino_id" required class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Selecciona un destino --</option>
                @foreach($destinos as $destino)
                    <option value="{{ $destino->id }}" {{ old('destino_id') == $destino->id ? 'selected' : '' }}>
                        {{ $destino->nombre }} - {{ $destino->pais }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('destino_id')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label for="fecha_inicio" class="block text-gray-700">Fecha de inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', $viaje->fecha_inicio ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="fecha_fin" class="block text-gray-700">Fecha de fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', $viaje->fecha_fin ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <x-input-label for="foto" :value="__('Foto (opcional)')" />
            <input id="foto" name="foto" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700
                hover:file:bg-indigo-100
            " />
            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar viaje') }}</x-primary-button>
            <a href="{{ route('viajes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                {{ __('Cancelar') }}
            </a>
        </div>
    </form>
</div>
@endsection
