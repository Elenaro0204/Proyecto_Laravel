@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12 max-w-6xl">
    <!-- Bienvenida -->
    <div class="bg-white rounded-xl shadow-lg p-8 mb-10">
        <h1 class="text-4xl font-extrabold mb-4 text-gray-700">
            ¡Bienvenid@, <span class="text-indigo-600">{{ Auth::user()->name }}</span>!
        </h1>
        <p class="text-gray-700 mb-8 text-lg">
            Explora tus viajes, conecta con otros viajeros y descubre nuevos destinos.
        </p>
        <div class="flex flex-wrap justify-center gap-6 mb-6">
            <a href="{{ route('viajes.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
               Crear nuevo viaje
            </a>

            <a href="{{ route('viajes.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
               Ver todos los viajes
            </a>

            <a href="{{ route('profile.index') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
               Mi Perfil
            </a>
        </div>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h2 class="text-3xl font-bold text-indigo-600">
                {{ $viajesCount ?? 0 }}
            </h2>
            <p class="text-gray-600 mt-2 font-medium">Viajes creados</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h2 class="text-3xl font-bold text-indigo-600">
                {{ $destinosCount ?? 0 }}
            </h2>
            <p class="text-gray-600 mt-2 font-medium">Destinos posibles</p>
        </div>
    </div>

    <!-- Últimos viajes -->
    <div class="bg-white rounded-xl shadow-lg p-8 mb-10">
        <h2 class="text-2xl font-bold mb-6 text-gray-900">Tus últimos viajes</h2>

        @if(isset($ultimosViajes) && $ultimosViajes->count())
            <ul class="space-y-4">
                @foreach($ultimosViajes as $viaje)
                    <li class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition cursor-pointer">
                        <h3 class="text-xl font-semibold text-indigo-600">{{ $viaje->titulo }}</h3>
                        <p class="text-gray-700">{{ Str::limit($viaje->descripcion, 100) }}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            Fecha: {{ $viaje->fecha_inicio->format('d M, Y') }} - {{ $viaje->fecha_fin->format('d M, Y') }}
                        </p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">No has creado viajes recientemente.</p>
        @endif
    </div>

    <!-- Destinos populares -->
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-900">Destinos populares</h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-6">
            @foreach($destinosPopulares ?? [] as $destino)
                <div class="rounded-lg overflow-hidden shadow hover:shadow-lg transition cursor-pointer">
                    <img src="{{ asset('storage/' . $destino->imagen) }}" alt="{{ $destino->nombre }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-indigo-600">{{ $destino->nombre }}</h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($destino->descripcion, 60) }}</p>
                    </div>
                </div>
            @endforeach
            @if(empty($destinosPopulares))
                <p class="text-gray-600">No hay destinos populares disponibles.</p>
            @endif
        </div>
    </div>
</div>
@endsection
