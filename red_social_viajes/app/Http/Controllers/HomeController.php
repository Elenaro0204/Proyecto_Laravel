<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Destino;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $ultimosViajes = $user->viajes()->latest('fecha_inicio')->take(5)->get();

        $destinosPopulares = Destino::orderBy('created_at', 'desc')->get();

        $viajesCount = auth()->user()->viajes()->count();

        // Simplemente contar todos los destinos en la tabla destinos
        $destinosCount = \App\Models\Destino::count();

        return view('index', compact('viajesCount', 'destinosCount', 'ultimosViajes', 'destinosPopulares'));
    }
}
