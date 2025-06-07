@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6 sm:px-8 lg:px-10 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-extrabold text-indigo-700 mb-8 text-center">Editar destino</h1>

    @if ($errors->any())
        <div class="mb-6 rounded border border-red-400 bg-red-50 p-4 text-red-700 shadow-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('destinos.update', $destino) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">Nombre</label>
            <input
                type="text"
                name="nombre"
                id="nombre"
                value="{{ old('nombre', $destino->nombre) }}"
                required
                class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                placeholder="Nombre del destino"
            />
        </div>

        <div>
            <label for="pais" class="block text-sm font-semibold text-gray-700 mb-2">País</label>
            <input
                type="text"
                name="pais"
                id="pais"
                value="{{ old('pais', $destino->pais) }}"
                required
                class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                placeholder="País del destino"
            />
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-2">Descripción</label>
            <textarea
                name="descripcion"
                id="descripcion"
                rows="5"
                class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                placeholder="Descripción del destino"
            >{{ old('descripcion', $destino->descripcion) }}</textarea>
        </div>

        <div>
            <label for="imagen" class="block text-sm font-semibold text-gray-700 mb-2">Imagen (opcional)</label>
            <input
                id="imagen"
                name="imagen"
                type="file"
                accept="image/*"
                class="w-full text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer"
            />
            @if($destino->imagen)
                <div class="mt-4">
                    <p class="text-gray-600 text-sm mb-1">Imagen actual:</p>
                    <img src="{{ asset('storage/' . $destino->imagen) }}" alt="Imagen del destino" class="w-40 rounded-md border border-gray-300 shadow-sm object-cover" />
                </div>
            @endif
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('destinos.index') }}"
                class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
            >
                Actualizar destino
            </button>
        </div>
    </form>
</div>
@endsection
