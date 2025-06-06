@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        Bienvenida, {{ Auth::user()->name }}
    </h2>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Viajes recientes</h1>
        <a href="{{ route('viajes.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">
           Crear nuevo viaje
        </a>
    </div>

    @if ($viajes->count())
        <div class="space-y-6">
            @foreach ($viajes as $viaje)
                <div class="bg-white shadow rounded-lg p-6">
                    <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ $viaje->titulo }}</h4>
                    <p class="text-gray-700 mb-3">{{ $viaje->descripcion }}</p>
                    <p class="text-gray-600 mb-1"><strong>Destino:</strong> {{ $viaje->destino->nombre ?? 'Sin destino' }}</p>
                    <p class="text-gray-600 mb-3"><strong>Publicado por:</strong> {{ $viaje->user->name ?? 'Usuario desconocido' }}</p>

                    @if($viaje->foto)
                        <img src="{{ asset('storage/' . $viaje->foto) }}" alt="Foto del viaje" class="max-w-full h-auto rounded mb-3">
                    @endif

                    <small class="text-gray-500">{{ $viaje->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">No hay viajes publicados aún.</p>
    @endif
</div>
@endsection
