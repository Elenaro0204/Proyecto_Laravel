<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destino;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

class DestinoController extends Controller
{
    public function index()
    {
        $destinos = Destino::paginate(10);
        return view('destinos.index', compact('destinos'));
    }

    public function create()
    {
        return view('destinos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreSlug = Str::slug($request->nombre);
            $extension = $file->getClientOriginalExtension();
            $filename = $nombreSlug . '.' . $extension;

            $path = $file->storeAs('destinos', $filename, 'public');
        }

        Destino::create([
            'nombre' => $request->nombre,
            'pais' => $request->pais,
            'descripcion' => $request->descripcion,
            'imagen' => $path,
        ]);

        return redirect()->route('destinos.index')->with('success', 'Destino creado correctamente.');
    }


    public function edit(Destino $destino)
    {
        return view('destinos.edit', compact('destino'));
    }

    public function update(Request $request, Destino $destino)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $destino->imagen;

        if ($request->hasFile('imagen')) {
            // Borramos la imagen anterior si existe
            if ($destino->imagen) {
                Storage::disk('public')->delete($destino->imagen);
            }

            $file = $request->file('imagen');
            $nombreSlug = Str::slug($request->nombre);
            $extension = $file->getClientOriginalExtension();
            $filename = $nombreSlug . '.' . $extension;

            $path = $file->storeAs('destinos', $filename, 'public');
        }

        $destino->update([
            'nombre' => $request->nombre,
            'pais' => $request->pais,
            'descripcion' => $request->descripcion,
            'imagen' => $path,
        ]);

        return redirect()->route('destinos.index')->with('success', 'Destino actualizado correctamente.');
    }

    public function destroy(Destino $destino)
    {

        if ($destino->imagen) {
            Storage::disk('public')->delete($destino->imagen);
        }

        $destino->delete();

        return redirect()->route('destinos.index')->with('success', 'Destino eliminado correctamente.');
    }
}
