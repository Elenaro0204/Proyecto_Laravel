@extends('layouts.app')

@section('content')
<div class="container max-w-md mx-auto py-8">
    <h1 class="text-xl font-bold mb-4">Editar Usuario</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name">Nombre</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label for="email">Correo</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border p-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
    </form>
</div>
@endsection
