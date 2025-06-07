@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Panel de Administración</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-6 bg-white shadow rounded">
            <h2 class="text-xl font-semibold mb-2">Gestión de Usuarios</h2>
            <p>Ver, editar o eliminar usuarios registrados.</p>
            <a href="{{ route('admin.users.index') }}" class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded">Ir a Usuarios</a>
        </div>

        <div class="p-6 bg-white shadow rounded">
            <h2 class="text-xl font-semibold mb-2">Gestión de Viajes</h2>
            <p>Ver, editar o eliminar todos los viajes.</p>
            <a href="{{ route('admin.viajes.index') }}" class="mt-3 inline-block bg-green-600 text-white px-4 py-2 rounded">Ir a Viajes</a>
        </div>

        <div class="p-6 bg-white shadow rounded">
            <h2 class="text-xl font-semibold mb-2">Gestión de Destinos</h2>
            <p>Ver, editar o eliminar todos los destinos.</p>
            <a href="{{ route('destinos.index') }}" class="mt-3 inline-block bg-purple-600 text-white px-4 py-2 rounded">Ir a Destinos</a>
        </div>
    </div>
</div>
@endsection
