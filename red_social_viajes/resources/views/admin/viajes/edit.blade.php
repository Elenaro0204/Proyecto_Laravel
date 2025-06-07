@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 max-w-3xl">
    <h1 class="text-3xl font-bold mb-6">Editar viaje</h1>

    <form action="{{ route('admin.viajes.update', $viaje->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $viaje->titulo) }}" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
            @error('titulo')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('descripcion', $viaje->descripcion) }}</textarea>
            @error('descripcion')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="destino_id" class="block text-sm font-medium text-gray-700">Destino</label>
            <select name="destino_id" id="destino_id" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Selecciona un destino</option>
                @foreach($destinos as $destino)
                    <option value="{{ $destino->id }}" {{ old('destino_id', $viaje->destino_id) == $destino->id ? 'selected' : '' }}>
                        {{ $destino->nombre }} - {{ $destino->ubicacion }}
                    </option>
                @endforeach
            </select>
            @error('destino_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
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
            <label for="foto" class="block text-sm font-medium text-gray-700">Foto (opcional)</label>
            <input type="file" name="foto" id="foto"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded file:border-0 file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
            @if($viaje->foto)
                <p class="mt-2">Foto actual:</p>
                <img src="{{ asset('storage/' . $viaje->foto) }}" alt="Foto viaje" class="w-48 rounded mt-1" />
            @endif
            @error('foto')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
            Guardar cambios
        </button>
    </form>
</div>
@endsection
