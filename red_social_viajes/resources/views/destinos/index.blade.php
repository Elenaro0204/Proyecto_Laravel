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
                        <td class="px-6 py-4 max-w-xs text-sm text-gray-600">{{ Str::limit($destino->descripcion, 70) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($destino->imagen)
                                <img src="{{ asset('storage/' . $destino->imagen) }}" alt="{{ $destino->nombre }}" class="inline-block h-16 w-24 object-cover rounded-md border border-gray-300 shadow-sm" />
                            @else
                                <span class="text-gray-400 italic text-xs">Sin imagen</span>
                            @endif
                        </td>
                        @if(auth()->check() && auth()->user()->isAdmin())
                        <td class="px-6 py-4 whitespace-nowrap text-center space-x-4">
                            <a href="{{ route('destinos.edit', $destino) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Editar</a>
                            <form action="{{ route('destinos.destroy', $destino) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que quieres eliminar este destino?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
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
</div>
@endsection
