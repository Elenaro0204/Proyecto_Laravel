@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold text-center mb-8 text-indigo-700">Lista de Viajes</h1>

    <a href="{{ route('viajes.create') }}"
        class="inline-block mb-6 rounded bg-indigo-600 text-white px-5 py-2 hover:bg-indigo-700 transition">
        + Crear nuevo viaje
    </a>

    @if ($viajes->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ($viajes as $viaje)
                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-500 overflow-hidden flex flex-col">
                    @if($viaje->foto)
                        <img src="{{ asset('storage/' . $viaje->foto) }}" alt="Foto del viaje"
                             class="w-full h-56 object-cover rounded-t-2xl transition-transform duration-500 hover:scale-105" />
                    @else
                        <div class="w-full h-56 bg-gray-100 flex items-center justify-center text-gray-400 text-xl italic select-none rounded-t-2xl">
                            Sin imagen disponible
                        </div>
                    @endif

                    <div class="p-6 flex flex-col flex-grow">
                        <h4 class="text-3xl font-semibold text-gray-900 mb-3 truncate">{{ $viaje->titulo }}</h4>
                        <p class="text-gray-700 flex-grow mb-6 leading-relaxed line-clamp-4">{{ $viaje->descripcion }}</p>

                        <div class="text-gray-600 space-y-2 mb-6 text-sm font-medium">
                            <p><span class="font-semibold text-gray-800">Destino:</span> {{ $viaje->destino->nombre ?? 'Sin destino' }} - {{ $viaje->destino->pais ?? 'Sin pais' }}</p>
                            <p><span class="font-semibold text-gray-800">Fecha:</span>
                                {{ $viaje->fecha_inicio ? \Carbon\Carbon::parse($viaje->fecha_inicio)->format('d/m/Y') : '-' }} &mdash;
                                {{ $viaje->fecha_fin ? \Carbon\Carbon::parse($viaje->fecha_fin)->format('d/m/Y') : '-' }}
                            </p>
                            <p class="font-semibold text-gray-800">
                                Enlace:
                                <a href="https://www.google.com/maps/search/{{ urlencode($viaje->destino->nombre . ', ' . $viaje->destino->pais) }}" target="_blank" class="px-0 py-4 whitespace-nowrap text-sm text-indigo-600 underline">
                                    Ver en Maps
                                </a>
                            </p>
                            <p><span class="font-semibold text-gray-800">Publicado por:</span> {{ $viaje->user->name ?? 'Usuario desconocido' }}</p>
                        </div>

                        <small class="text-gray-400 mb-6 block">{{ $viaje->created_at->format('d/m/Y H:i') }}</small>

                        <div class="mt-auto flex flex-wrap gap-3 items-center">
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <a href="{{ route('admin.viajes.edit', $viaje->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2 rounded-lg font-semibold shadow-md
                                          transition duration-300 transform hover:-translate-y-0.5">
                                    Editar
                                </a>

                                <form action="{{ route('admin.viajes.destroy', $viaje->id) }}" method="POST"
                                      onsubmit="return confirm('¿Seguro que quieres eliminar este viaje?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold shadow-md
                                                   transition duration-300 transform hover:-translate-y-0.5">
                                        Eliminar
                                    </button>
                                </form>
                            @else
                                @can('update', $viaje)
                                <a href="{{ route('viajes.edit', $viaje->id) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2 rounded-lg font-semibold shadow-md
                                        transition duration-300 transform hover:-translate-y-0.5">
                                    Editar
                                </a>

                                <form action="{{ route('viajes.destroy', $viaje->id) }}" method="POST"
                                    onsubmit="return confirm('¿Seguro que quieres eliminar este viaje?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold shadow-md
                                                transition duration-300 transform hover:-translate-y-0.5">
                                        Eliminar
                                    </button>
                                </form>
                                @else
                                    <p class="text-indigo-400 italic ml-2">No autorizado</p>
                                @endcan
                            @endif


                            @can('view', $viaje)
                                <a href="{{ route('viajes.show', $viaje->id) }}"
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
        <p class="text-center text-gray-500 text-xl mt-32 italic select-none">No hay viajes publicados aún.</p>
    @endif
</div>
@endsection
