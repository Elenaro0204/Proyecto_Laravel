@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 max-w-3xl bg-white rounded-lg shadow-lg px-8">
    <h1 class="text-4xl font-extrabold text-indigo-700 mb-8 border-b-2 border-indigo-300 pb-3">Editar viaje</h1>

    <form action="{{ route('admin.viajes.update', $viaje->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div>
            <label for="titulo" class="block text-sm font-semibold text-gray-800 mb-2">Título</label>
            <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $viaje->titulo) }}" required
                class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" />
            @error('titulo')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-semibold text-gray-800 mb-2">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="5" required
                class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 placeholder-gray-400 resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">{{ old('descripcion', $viaje->descripcion) }}</textarea>
            @error('descripcion')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="destino_id" class="block text-sm font-semibold text-gray-800 mb-2">Destino</label>
            <select name="destino_id" id="destino_id" required
                class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="fecha_inicio" class="block text-sm font-semibold text-gray-800 mb-2">Fecha de inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', $viaje->fecha_inicio ?? '') }}"
                    class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" />
            </div>

            <div>
                <label for="fecha_fin" class="block text-sm font-semibold text-gray-800 mb-2">Fecha de fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', $viaje->fecha_fin ?? '') }}"
                    class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" />
            </div>
        </div>

        <div>
            <label for="foto" class="block text-sm font-semibold text-gray-800 mb-2">Foto (opcional)</label>
            <input type="file" name="foto" id="foto"
                class="w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
            @if($viaje->foto)
                <p class="mt-4 font-medium text-gray-700">Foto actual:</p>
                <img src="{{ asset('storage/' . $viaje->foto) }}" alt="Foto viaje" class="w-48 rounded-lg mt-2 shadow-md object-cover" />
            @endif
            @error('foto')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-indigo-600 text-white py-3 rounded-md text-lg font-semibold hover:bg-indigo-700 transition-shadow shadow-md hover:shadow-lg">
            Guardar cambios
        </button>
    </form>
</div>
@endsection
