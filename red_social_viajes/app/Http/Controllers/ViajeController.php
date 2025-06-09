<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Viaje;
use App\Models\Destino;

class ViajeController extends Controller
{
    // Metodos para usuarios
    public function index()
    {
        // Traemos los viajes con su usuario y destino para mostrar datos completos
        $viajes = Viaje::with('user', 'destino')->latest()->get();
        return view('viajes.index', compact('viajes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'destino_id' => 'required|exists:destinos,id',
            'foto' => 'nullable|image|max:2048', // Imagen opcional
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',

        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos', 'public');
        }

        Viaje::create([
            'user_id' => auth()->id(),  // Asignamos el usuario autenticado automáticamente
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'destino_id' => $request->destino_id,
            'foto' => $path,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,

        ]);

        return redirect()->route('viajes.index')->with('success', 'Viaje creado correctamente.');
    }

    public function create()
    {
        // Pasamos todos los destinos para que el usuario pueda elegir
        $destinos = Destino::all(); // si tienes ese modelo

        return view('viajes.create', compact('destinos'));
    }

    public function edit(Viaje $viaje)
    {

        $destinos = Destino::all();
        return view('viajes.edit', compact('viaje', 'destinos'));
    }

    public function update(Request $request, Viaje $viaje)
    {

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'destino_id' => 'required|exists:destinos,id',
            'foto' => 'nullable|image|max:2048',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',

        ]);

        $path = $viaje->foto;

        if ($request->hasFile('foto')) {
            // Opcional: borrar la foto vieja si existe
            if ($viaje->foto) {
                \Storage::disk('public')->delete($viaje->foto);
            }
            $path = $request->file('foto')->store('fotos', 'public');
        }

        $viaje->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'destino_id' => $request->destino_id,
            'foto' => $path,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,

        ]);

        return redirect()->route('viajes.index')->with('success', 'Viaje actualizado correctamente.');
    }

    public function destroy(Viaje $viaje)
    {

        // Eliminar foto si existe
        if ($viaje->foto) {
            \Storage::disk('public')->delete($viaje->foto);
        }

        $viaje->delete();

        return redirect()->route('viajes.index')->with('success', 'Viaje eliminado correctamente.');
    }

    // Metodos para admins
    public function indexAdmin()
    {
        $viajes = Viaje::with('user', 'destino')->latest()->get();
        return view('admin.viajes.index', compact('viajes'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'destino_id' => 'required|exists:destinos,id',
            'foto' => 'nullable|image|max:2048', // Imagen opcional
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',

        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos', 'public');
        }

        Viaje::create([
            'user_id' => auth()->id(),  // Asignamos el usuario autenticado automáticamente
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'destino_id' => $request->destino_id,
            'foto' => $path,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,

        ]);

        return redirect()->route('admin.viajes.index')->with('success', 'Viaje creado correctamente.');
    }

    public function createAdmin()
    {
        // Pasamos todos los destinos para que el usuario pueda elegir
        $destinos = Destino::all(); // si tienes ese modelo

        return view('admin.viajes.create', compact('destinos'));
    }

    public function editAdmin(Viaje $viaje)
    {
        $destinos = Destino::all();
        return view('admin.viajes.edit', compact('viaje', 'destinos'));
    }

    public function updateAdmin(Request $request, Viaje $viaje)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'destino_id' => 'required|exists:destinos,id',
            'foto' => 'nullable|image|max:2048',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',

        ]);

        $path = $viaje->foto;

        if ($request->hasFile('foto')) {
            // Opcional: borrar la foto vieja si existe
            if ($viaje->foto) {
                \Storage::disk('public')->delete($viaje->foto);
            }
            $path = $request->file('foto')->store('fotos', 'public');
        }

        $viaje->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'destino_id' => $request->destino_id,
            'foto' => $path,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,

        ]);

        return redirect()->route('admin.viajes.index')->with('success', 'Viaje actualizado correctamente.');
    }

    public function destroyAdmin(Viaje $viaje)
    {
        // Eliminar foto si existe
        if ($viaje->foto) {
            \Storage::disk('public')->delete($viaje->foto);
        }

        $viaje->delete();

        return redirect()->route('admin.viajes.index')->with('success', 'Viaje eliminado correctamente.');
    }
}
