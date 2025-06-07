<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destino;

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

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/destinos', $filename);
            $validatedData['imagen'] = $filename;
        }

        Destino::create($validatedData);

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

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/destinos', $filename);
            $validatedData['imagen'] = $filename;

            // Opcional: borrar la imagen antigua si quieres limpiar almacenamiento
            Storage::delete('public/destinos/' . $destino->imagen);
        }

        $destino->update($request->all());

        return redirect()->route('destinos.index')->with('success', 'Destino actualizado correctamente.');
    }

    public function destroy(Destino $destino)
    {
        $destino->delete();

        return redirect()->route('destinos.index')->with('success', 'Destino eliminado correctamente.');
    }
}
