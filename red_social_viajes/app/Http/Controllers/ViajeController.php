<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Viaje;
use App\Models\Destino;

class ViajeController extends Controller
{
    public function index()
    {
        $viajes = Viaje::with('user', 'destino')->latest()->get();
        return view('viajes.index', compact('viajes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'destino_id' => 'required|exists:destinos,id',
            'foto' => 'nullable|image|max:2048', // Validar que sea imagen y tamaño max 2MB (opcional)
        ]);

        if ($request->hasFile('foto')) {
            // Guarda la foto en storage/app/public/fotos y devuelve la ruta
            $path = $request->file('foto')->store('fotos', 'public');
        } else {
            $path = null;
        }

        Viaje::create([
            'user_id' => auth()->id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'destino_id' => $request->destino_id,
            'foto' => $path,
        ]);

        return redirect()->route('viajes.index');
    }

    public function create()
    {
        // Puedes pasar datos necesarios, como destinos para seleccionar
        $destinos = Destino::all(); // si tienes ese modelo

        return view('viajes.create', compact('destinos'));
    }
}
