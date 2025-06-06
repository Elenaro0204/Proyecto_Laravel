<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Info Usuario --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Información del Usuario</h3>

                <div class="space-y-3 text-gray-700">
                    <p><strong>Nombre:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Registrado desde:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                </div>

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('profile.edit') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-center">
                        Editar Perfil
                    </a>
                </div>
            </div>

            {{-- Viajes del usuario --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Mis Publicaciones de Viajes</h3>

                @if(isset($viajes) && $viajes->count())
                    <h3>Mis viajes publicados</h3>
                    <ul>
                        @foreach($viajes as $viaje)
                            <li>{{ $viaje->titulo }} - {{ $viaje->fecha }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No tienes viajes publicados.</p>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
