@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold text-center mb-8 text-indigo-700">Lista de Destinos</h1>

    @if(session('success'))
        <div class="mb-6 rounded bg-green-100 border border-green-400 text-green-700 px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('destinos.create') }}" class="inline-block mb-6 rounded bg-indigo-600 text-white px-5 py-2 hover:bg-indigo-700 transition">
            + Nuevo destino
        </a>
    @endif

    @if($destinos->count())
        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">País</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-600 uppercase tracking-wider">Imagen</th>
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-600 uppercase tracking-wider">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($destinos as $destino)
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $destino->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $destino->pais }}</td>
                        <td class="px-6 py-4 max-w-xs text-sm text-gray-600">{{ $destino->descripcion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($destino->imagen)
                                <img src="{{ asset('storage/' . $destino->imagen) }}" alt="{{ $destino->nombre }}" class="inline-block h-16 w-24 object-cover rounded-md border border-gray-300 shadow-sm" />
                            @else
                                <span class="text-gray-400 italic text-xs">Sin imagen</span>
                            @endif
                        </td>
                        @if(auth()->check() && auth()->user()->isAdmin())
                        <td class="px-6 py-4 whitespace-nowrap text-center space-x-4">
                            <a href="{{ route('destinos.edit', $destino) }}" class="inline-flex items-center bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-4 py-1 rounded transition font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h6M9 7v10a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-6M16 3l-4 4m-1 3l5 5" />
                            </svg>
                            Editar
                        </a>
                            <form action="{{ route('destinos.destroy', $destino) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que quieres eliminar este destino?');">
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
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $destinos->links() }}
        </div>
    @else
        <p class="text-gray-600 italic">No hay destinos disponibles.</p>
    @endif

    @if(auth()->check() && auth()->user()->isAdmin())
        <div class="flex space-x-4 mt-6">
            <a href="{{ route('admin.index') }}"
            class="flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al Inicio
            </a>
        </div>
    @else
        <div class="flex space-x-4 mt-6">
            <a href="{{ route('index') }}"
            class="flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al Inicio
            </a>
        </div>
    @endif
</div>
@endsection
