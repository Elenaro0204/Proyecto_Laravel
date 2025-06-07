@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4 max-w-6xl">
    <h1 class="text-3xl font-bold mb-8 text-indigo-700">Gestión de Usuarios</h1>

    <a href="{{ route('admin.users.create') }}" class="inline-block mb-6 rounded bg-indigo-600 text-white px-5 py-2 hover:bg-indigo-700 transition">
        + Crear nuevo usuario
    </a>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Admin</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Fecha Registro</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                <tr class="border-b border-gray-200 hover:bg-indigo-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        @if($user->is_admin)
                            <span class="inline-block bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Sí</span>
                        @else
                            <span class="inline-block bg-gray-200 text-gray-600 px-3 py-1 rounded-full text-xs font-semibold">No</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="py-4 px-6 border-b border-gray-200 text-center space-x-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-4 py-1 rounded transition font-semibold">
                            Editar
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded font-semibold transition">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($users->isEmpty())
                <tr>
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        No hay usuarios registrados aún.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
