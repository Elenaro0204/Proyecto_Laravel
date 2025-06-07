@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Título --}}
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Perfil de {{ $user->name }}
        </h2>

        {{-- Info Usuario --}}
        <div class="bg-white shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Información del Usuario</h3>
            <div class="space-y-3 text-gray-700">
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Registrado desde:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('profile.edit') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-center">
                    Editar Perfil
                </a>
            </div>
        </div>

        {{-- Viajes del usuario --}}
        <div class="bg-white shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Mis Publicaciones de Viajes</h3>

            @if(isset($viajes) && $viajes->count())
                <ul class="list-disc list-inside text-gray-700">
                    @foreach($viajes as $viaje)
                        <li>{{ $viaje->titulo }} - {{ $viaje->fecha_inicio?->format('d/m/Y') ?? 'Sin fecha' }}</li>
                    @endforeach
                </ul>
            @else
                <p>No tienes viajes publicados.</p>
            @endif
        </div>

    </div>
@endsection
