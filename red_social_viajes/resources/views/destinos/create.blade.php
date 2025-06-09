@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-10 bg-white rounded-2xl shadow-2xl border border-gray-100">
    <h1 class="text-4xl font-extrabold text-indigo-700 mb-12 text-center tracking-tight drop-shadow-sm">Crear nuevo destino</h1>

    @if ($errors->any())
        <div class="mb-6 rounded bg-red-100 border border-red-400 text-red-700 px-4 py-3">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('destinos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="pais" class="block text-sm font-medium text-gray-700">País</label>
            <input type="text" name="pais" id="pais" value="{{ old('pais') }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion') }}</textarea>
        </div>

        <div>
            <x-input-label for="imagen" :value="__('Foto (opcional)')" />
            <input id="imagen" name="imagen" type="file" accept="destino/*" class="mt-1 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700
                hover:file:bg-indigo-100
            " />
            <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
        </div>

        <div class="flex space-x-3">
            <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-white text-sm font-medium shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Guardar destino
            </button>
            <a href="{{ route('destinos.index') }}"
                class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
