@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 max-w-3xl bg-white shadow-lg rounded-lg px-8">
    <h1 class="text-4xl font-extrabold mb-8 text-indigo-700 border-b-2 border-indigo-300 pb-3">Crear nuevo viaje</h1>

    <form action="{{ route('viajes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div>
            <label for="titulo" class="block text-lg font-semibold text-gray-800 mb-1">Título</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required
                class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            @error('titulo')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-lg font-semibold text-gray-800 mb-1">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="5" required
                class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="fecha" class="block text-lg font-semibold text-gray-800 mb-1">Fecha</label>
            <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" required
                class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            @error('fecha')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="destino_id" class="block text-lg font-semibold text-gray-800 mb-1">Destino</label>
            <select name="destino_id" id="destino_id" required
                class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="" disabled selected>Selecciona un destino</option>
                @foreach($destinos as $destino)
                    <option value="{{ $destino->id }}" {{ old('destino_id') == $destino->id ? 'selected' : '' }}>
                        {{ $destino->nombre }} - {{ $destino->ubicacion }}
                    </option>
                @endforeach
            </select>
            @error('destino_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="fecha_inicio" class="block text-lg font-semibold text-gray-800 mb-1">Fecha de inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', $viaje->fecha_inicio ?? '') }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
            <div>
                <label for="fecha_fin" class="block text-lg font-semibold text-gray-800 mb-1">Fecha de fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', $viaje->fecha_fin ?? '') }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
        </div>

        <div>
            <label for="foto" class="block text-lg font-semibold text-gray-800 mb-1">Foto (opcional)</label>
            <input type="file" name="foto" id="foto"
                class="block w-full text-gray-600 file:mr-4 file:py-2 file:px-4
                       file:rounded file:border-0 file:text-sm file:font-semibold
                       file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
            @error('foto')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg
                   hover:bg-indigo-700 transition duration-300 ease-in-out shadow-md">
            Crear viaje
        </button>
    </form>
</div>
@endsection
