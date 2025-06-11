@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    @if(auth()->check() && auth()->user()->isAdmin())
        <h1 class="text-4xl font-extrabold text-center mb-8 text-indigo-700">Gestión Destinos</h1>
    @else
        <h1 class="text-4xl font-extrabold text-center mb-8 text-indigo-700">Lista de Destinos</h1>
    @endif

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


    @if(auth()->check() && auth()->user()->isAdmin())
        @if($destinos->count())
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">País</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Descripción</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-600 uppercase tracking-wider">Imagen</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-600 uppercase tracking-wider">Mapa</th>
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
                            <td class="px-6 py-4 max-w-xs text-sm text-gray-600">
                                <div class="overflow-y-auto max-h-16">
                                    {{ $destino->descripcion }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($destino->imagen)
                                    <img src="{{ asset('storage/' . $destino->imagen) }}"
                                        alt="{{ $destino->nombre }}"
                                        class="inline-block h-16 w-24 object-cover rounded-md border border-gray-300 shadow-sm" />
                                @else
                                    <span class="text-gray-400 italic text-xs">Sin imagen</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 underline">
                                <a href="https://www.google.com/maps/search/{{ urlencode($destino->nombre . ', ' . $destino->pais) }}" target="_blank">
                                    Ver en Maps
                                </a>
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
        @else
            <p class="text-gray-600 italic">No hay destinos disponibles.</p>
        @endif

    @else

        @if ($destinos->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($destinos as $destino)
                    <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-500 overflow-hidden flex flex-col">
                        @if($destino->imagen)
                            <img src="{{ asset('storage/' . $destino->imagen) }}" alt="Foto del destino"
                                class="w-full h-56 object-cover rounded-t-2xl transition-transform duration-500 hover:scale-105" />
                        @else
                            <div class="w-full h-56 bg-gray-100 flex items-center justify-center text-gray-400 text-xl italic select-none rounded-t-2xl">
                                Sin imagen disponible
                            </div>
                        @endif

                        <div class="p-6 flex flex-col flex-grow">
                            <h4 class="text-3xl font-semibold text-gray-900 mb-3 truncate">{{ $destino->nombre }}</h4>

                            <p class="px-6 max-w-xs">
                                <div class="text-gray-700 overflow-y-auto max-h-16">
                                    {{ $destino->descripcion }}
                                </div>
                            </p>

                            <div class="text-gray-600 py-4 space-y-2 mb-3 text-sm font-medium">
                                <p><span class="font-semibold text-gray-800">País:</span> {{ $destino->pais ?? 'Sin pais' }}</p>
                                <p>
                                    <span class="font-semibold text-gray-800">Enlace:</span>
                                    <a href="https://www.google.com/maps/search/{{ urlencode($destino->nombre . ', ' . $destino->pais) }}" target="_blank" class="ml-0 text-sm text-blue-600 underline">
                                        Ver en Maps
                                    </a>
                                </p>
                            </div>

                            <small class="text-gray-400 mb-6 block">{{ $destino->created_at->format('d/m/Y H:i') }}</small>

                            <div class="mt-auto flex flex-wrap gap-3 items-center">
                                @if(auth()->check() && auth()->user()->isAdmin())
                                    <a href="{{ route('destinos.edit', $destino->id) }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2 rounded-lg font-semibold shadow-md
                                            transition duration-300 transform hover:-translate-y-0.5">
                                        Editar
                                    </a>

                                    <form action="{{ route('destinos.destroy', $destino->id) }}" method="POST"
                                        onsubmit="return confirm('¿Seguro que quieres eliminar este destino?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold shadow-md
                                                    transition duration-300 transform hover:-translate-y-0.5">
                                            Eliminar
                                        </button>
                                    </form>
                                @else
                                    @can('update', $destino)
                                    <a href="{{ route('destinos.edit', $destino->id) }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2 rounded-lg font-semibold shadow-md
                                            transition duration-300 transform hover:-translate-y-0.5">
                                        Editar
                                    </a>

                                    <form action="{{ route('destinos.destroy', $destino->id) }}" method="POST"
                                        onsubmit="return confirm('¿Seguro que quieres eliminar este destino?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold shadow-md
                                                    transition duration-300 transform hover:-translate-y-0.5">
                                            Eliminar
                                        </button>
                                    </form>
                                    @else
                                        <p class="text-gray-400 italic ml-2">No estás autorizado, <span>{{ Auth::user()->name }}</span></p>
                                    @endcan
                                @endif


                                @can('view', $destino)
                                    <a href="{{ route('destinos.show', $destino->id) }}"
                                    class="ml-auto text-blue-600 hover:text-blue-800 font-semibold transition duration-300 underline-offset-4 hover:underline">
                                        Ver detalles &rarr;
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 text-xl mt-32 italic select-none">No hay destinos publicados aún.</p>
        @endif

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
