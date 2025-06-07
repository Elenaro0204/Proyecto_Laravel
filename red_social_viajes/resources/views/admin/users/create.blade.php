@extends('layouts.app')

@section('content')
<div class="container max-w-md mx-auto py-8">
    <h1 class="text-xl font-bold mb-4">Crear Usuario</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label for="email">Correo</label>
            <input type="email" name="email" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="w-full border p-2" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Crear</button>
    </form>
</div>
@endsection
