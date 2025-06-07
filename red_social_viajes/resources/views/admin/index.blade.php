@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4 max-w-5xl">
    {{-- Título --}}
    <h1 class="text-4xl font-extrabold text-center mb-8 text-indigo-700">Panel de Administración</h1>

    {{-- Descripción / Info general --}}
    <div class="mb-12 bg-indigo-50 border border-indigo-200 rounded-lg p-6 text-indigo-900 shadow-sm">
        <h2 class="text-2xl font-semibold mb-3">Bienvenido al panel administrativo</h2>
        <p class="text-gray-700 leading-relaxed">
            Desde aquí puedes gestionar todos los aspectos importantes de la web: usuarios registrados, publicaciones de viajes y destinos turísticos. Mantén el contenido actualizado y asegúrate de ofrecer la mejor experiencia a los usuarios.
        </p>
    </div>

    {{-- Cards de gestión --}}
    <div class="grid gap-8 md:grid-cols-3">

        {{-- Usuarios --}}
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-8 0v2"/><circle cx="12" cy="7" r="4"/></svg>
                <h3 class="text-xl font-semibold text-gray-900">Gestión de Usuarios</h3>
            </div>
            <p class="text-gray-600 mb-6">
                Consulta, edita o elimina usuarios registrados en la plataforma.
            </p>
            <a href="{{ route('admin.users.index') }}" class="inline-block px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Ir a Usuarios
            </a>
        </div>

        {{-- Viajes --}}
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10h-6l-2-7-2 7H3"/><path d="M5 10v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-10"/></svg>
                <h3 class="text-xl font-semibold text-gray-900">Gestión de Viajes</h3>
            </div>
            <p class="text-gray-600 mb-6">
                Administra las publicaciones de viajes: revisa, edita o elimina cualquier viaje.
            </p>
            <a href="{{ route('admin.viajes.index') }}" class="inline-block px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                Ir a Viajes
            </a>
        </div>

        {{-- Destinos --}}
        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l7 20H5l7-20z"/><circle cx="12" cy="16" r="1"/></svg>
                <h3 class="text-xl font-semibold text-gray-900">Gestión de Destinos</h3>
            </div>
            <p class="text-gray-600 mb-6">
                Controla los destinos turísticos disponibles en la web: añade, edita o elimina destinos.
            </p>
            <a href="{{ route('destinos.index') }}" class="inline-block px-5 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition">
                Ir a Destinos
            </a>
        </div>

    </div>
</div>
@endsection
