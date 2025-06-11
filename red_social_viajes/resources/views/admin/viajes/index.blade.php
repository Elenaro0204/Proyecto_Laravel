@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold text-center mb-8 text-indigo-700">Gestión Viajes</h1>

    <a href="{{ route('admin.viajes.create') }}"
       class="inline-block mb-6 rounded bg-indigo-600 text-white px-5 py-2 hover:bg-indigo-700 transition">
       + Crear nuevo viaje
    </a>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-50">
                <tr>
                    <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Título</th>
                    <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Descripción</th>
                    <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Creación</th>
                    <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Usuario</th>
                    <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Destino</th>
                    <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Fecha Inicio</th>
                    <th class="px-3 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Fecha Fin</th>
                    <th class="px-3 py-3 text-center text-xs font-semibold text-indigo-600 uppercase tracking-wider">Imagen</th>
                    <th class="px-3 py-3 text-center text-xs font-semibold text-indigo-600 uppercase tracking-wider">Mapa</th>
                    <th class="px-3 py-3 text-center text-xs font-semibold text-indigo-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($viajes as $viaje)
                <tr class="hover:bg-indigo-50 transition">
                    <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $viaje->titulo }}</td>
                    <td class="px-3 py-4 max-w-xs text-sm text-gray-600" title="{{ $viaje->descripcion }}">
                       <div class="overflow-y-auto max-h-16">
                            {{ $viaje->descripcion }}
                       </div>
                    </td>
                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-700">{{ $viaje->created_at->format('d/m/Y') }}</td>
                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-700">{{ $viaje->user->name ?? 'No asignado' }}</td>
                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-700">{{ $viaje->destino->nombre ?? 'Sin destino' }} - {{ $viaje->destino->pais ?? 'Sin pais' }}</td>
                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-700">{{ $viaje->fecha_inicio ? \Carbon\Carbon::parse($viaje->fecha_inicio)->format('d/m/Y') : '-' }}</td>
                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-700">{{ $viaje->fecha_fin ? \Carbon\Carbon::parse($viaje->fecha_fin)->format('d/m/Y') : '-' }}</td>
                    <td class="px-3 py-4 whitespace-nowrap text-center">
                        @if ($viaje->foto)
                            <img src="{{ asset('storage/' . $viaje->foto) }}"
                                 alt="Foto del viaje"
                                 class="inline-block h-16 w-24 object-cover rounded-md border border-gray-300 shadow-sm">
                        @else
                            <span class="text-gray-400 italic text-xs">Sin imagen</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 underline">
                        <a href="https://www.google.com/maps/search/{{ urlencode($viaje->destino->nombre . ', ' . $viaje->destino->pais) }}" target="_blank">
                            Ver en Maps
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center space-x-4">
                        <a href="{{ route('admin.viajes.edit', $viaje->id) }}"
                           class="inline-flex items-center bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-4 py-1 rounded transition font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h6M9 7v10a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-6M16 3l-4 4m-1 3l5 5" />
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('admin.viajes.destroy', $viaje->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás segura de eliminar este viaje?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                            class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded font-semibold transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                    Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($viajes->isEmpty())
                <tr>
                    <td colspan="9" class="text-gray-600 italic">No hay viajes disponibles.</td>
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
