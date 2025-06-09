@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-4xl font-extrabold text-center mb-8 text-indigo-700">Gestión Viajes</h1>

    <a href="{{ route('admin.viajes.create') }}"
       class="inline-block mb-6 rounded bg-indigo-600 text-white px-5 py-2 hover:bg-indigo-700 transition">
       + Crear nuevo viaje
    </a>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Título</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Creación</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Usuario</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Destino</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Fecha Inicio</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Fecha Fin</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($viajes as $viaje)
                <tr class="border-b border-gray-200 hover:bg-indigo-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $viaje->titulo }}</td>
                    <td class="px-6 py-4 max-w-xs text-sm text-gray-600" title="{{ $viaje->descripcion }}">{{ $viaje->descripcion }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $viaje->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $viaje->user->name ?? 'No asignado' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $viaje->destino->nombre ?? 'Sin destino' }} - {{ $viaje->destino->pais ?? 'Sin pais' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $viaje->fecha_inicio ? \Carbon\Carbon::parse($viaje->fecha_inicio)->format('d/m/Y') : '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $viaje->fecha_fin ? \Carbon\Carbon::parse($viaje->fecha_fin)->format('d/m/Y') : '-' }}</td>
                    <td class="py-3 px-4 text-center">
                        @if ($viaje->foto)
                            <img src="{{ asset('storage/' . $viaje->foto) }}"
                                 alt="Foto del viaje"
                                 class="w-20 h-20 object-cover rounded-md mx-auto border border-gray-300">
                        @else
                            <span class="text-gray-400 italic text-sm">Sin foto</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center space-x-2">
                        <a href="{{ route('admin.viajes.edit', $viaje->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow text-sm font-semibold">
                           Editar
                        </a>
                        <form action="{{ route('admin.viajes.destroy', $viaje->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás segura de eliminar este viaje?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow text-sm font-semibold">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($viajes->isEmpty())
                <tr>
                    <td colspan="9" class="text-center py-6 text-gray-500 italic">No hay viajes disponibles.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="flex space-x-4 mt-6">
        <a href="{{ route('admin.index') }}"
        class="flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Volver al Inicio
        </a>
    </div>
</div>
@endsection
