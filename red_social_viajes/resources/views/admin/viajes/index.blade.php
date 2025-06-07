@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Gestión de Viajes</h1>

    <a href="{{ route('admin.viajes.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">Crear nuevo viaje</a>

    <table class="min-w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4">Título</th>
                <th class="py-2 px-4">Descripción</th>
                <th class="py-2 px-4">Fecha de creación</th>
                <th class="py-2 px-4">Usuario</th>
                <th class="py-2 px-4">Destino</th>
                <th class="py-2 px-4">Fecha de Inicio</th>
                <th class="py-2 px-4">Fecha de Fin</th>
                <th class="py-2 px-4">Foto</th>
                <th class="py-2 px-4">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viajes as $viaje)
            <tr class="border-b">
                <td class="py-2 px-4">{{ $viaje->titulo }}</td>
                <td class="py-2 px-4">{{ $viaje->descripcion }}</td>
                <td class="py-2 px-4">{{ $viaje->created_at->format('d/m/Y') }}</td>
                <td class="py-2 px-4">{{ $viaje->user->name ?? 'No asignado' }}</td>
                <td class="py-2 px-4">{{ $viaje->destino->nombre ?? 'Sin destino' }}</td>
                <td class="py-2 px-4">{{ $viaje->fecha_inicio ? \Carbon\Carbon::parse($viaje->fecha_inicio)->format('d/m/Y') : '-' }}</td>
                <td class="py-2 px-4">{{ $viaje->fecha_fin ? \Carbon\Carbon::parse($viaje->fecha_fin)->format('d/m/Y') : '-' }}</td>
                <td class="py-2 px-4">
                    @if ($viaje->foto)
                        <img src="{{ asset('storage/' . $viaje->foto) }}" alt="Foto del viaje" class="w-24 h-24 object-cover rounded">
                    @else
                        <span class="text-gray-500 italic">Sin foto</span>
                    @endif
                </td>
                <td class="py-2 px-4">
                    <a href="{{ route('admin.viajes.edit', $viaje->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
                    <form action="{{ route('admin.viajes.destroy', $viaje->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás segura de eliminar este viaje?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-3 py-1 rounded">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
