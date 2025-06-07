<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Viaje;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();  // Obtener usuario autenticado

        // Opcionalmente, obtener los viajes de ese usuario
        $viajes = $user->viajes; // Asumiendo que tienes la relación definida
        // dd($user, $viajes);
        return view('profile.index', compact('user', 'viajes'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.index')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        // Validar formulario
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Verificar que la contraseña actual coincida
        if (!Hash::check($request->current_password, $user->password)) {
            // Puedes usar ValidationException para mostrar error en el formulario
            throw ValidationException::withMessages([
                'current_password' => 'La contraseña actual no es correcta.',
            ]);
        }

        // Actualizar la contraseña
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirigir con mensaje de éxito (puedes usar session flash)
        return redirect()->route('profile.edit')->with('status', 'Contraseña actualizada correctamente.');
    }
}
