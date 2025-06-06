@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-semibold mb-6">Lista de Destinos</h1>

    @if(session('success'))
        <div class="mb-6 rounded bg-green-100 border border-green-400 text-green-700 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('destinos.create') }}" class="inline-block mb-4 rounded bg-indigo-600 text-white px-4 py-2 hover:bg-indigo-700">Nuevo destino</a>
    @endif

    @if($destinos->count())
        <table class="min-w-full border border-gray-200 rounded">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="px-4 py-2 border-b">Nombre</th>
                    <th class="px-4 py-2 border-b">País</th>
                    <th class="px-4 py-2 border-b">Descripción</th>
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <th class="px-4 py-2 border-b">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($destinos as $destino)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $destino->nombre }}</td>
                    <td class="px-4 py-2">{{ $destino->pais }}</td>
                    <td class="px-4 py-2">{{ Str::limit($destino->descripcion, 50) }}</td>
                    @if(auth()->check() && auth()->user()->isAdmin())
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('destinos.edit', $destino) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                        <form action="{{ route('destinos.destroy', $destino) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que quieres eliminar este destino?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $destinos->links() }}
        </div>
    @else
        <p>No hay destinos disponibles.</p>
    @endif
</div>
@endsection
