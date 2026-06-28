<?php

namespace App\Http\Controllers;

use App\Models\Traveler;
use App\Models\TravelerAuth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TravelerAuthController extends Controller
{
    /**
     * Registra un nuevo viajero e inicia sesión.
     */
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email'      => 'required|email|max:255|unique:travelers_auth,email',
            'password'   => 'required|string|min:8|confirmed',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
        ]);

        $auth = TravelerAuth::create([
            'email'            => $data['email'],
            'password_hash'    => Hash::make($data['password']),
            'auth_key'         => Str::random(32),
            'registration_ip'  => $request->ip(),
            'confirmed_at'     => now()->timestamp,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        Traveler::create([
            'travelers_auth_id' => $auth->id,
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        Auth::login($auth);
        $request->session()->regenerate();

        return redirect()
            ->intended(route('home'))
            ->with('status', 'Registro exitoso. Bienvenido.');
    }

    /**
     * Inicia sesión de un viajero existente.
     */
    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt([
            'email'    => $data['email'],
            'password' => $data['password'],
        ], $remember)) {
            return back()
                ->withErrors(['email' => 'Las credenciales no son correctas.'])
                ->withInput($request->only('email'));
        }

        /** @var TravelerAuth $auth */
        $auth = Auth::user();

        if ($auth->blocked_at) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()
                ->withErrors(['email' => 'Tu cuenta ha sido bloqueada. Contacta a soporte.'])
                ->withInput($request->only('email'));
        }

        $auth->update([
            'last_login_at' => now()->timestamp,
            'last_login_ip' => $request->ip(),
            'updated_at'    => now(),
        ]);

        $request->session()->regenerate();

        return redirect()
            ->intended(route('home'))
            ->with('status', 'Inicio de sesión exitoso.');
    }

    /**
     * Cierra la sesión del viajero.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('status', 'Sesión cerrada correctamente.');
    }
}
