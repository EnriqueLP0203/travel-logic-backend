<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Traveler;
use App\Models\TravelerAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registro de un nuevo traveler.
     * POST /api/auth/register
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email'      => 'required|email|unique:travelers_auth,email',
            'password'   => 'required|string|min:8|confirmed',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
        ]);

        // Crear la cuenta de autenticación
        $auth = TravelerAuth::create([
            'email'         => $data['email'],
            'password_hash' => Hash::make($data['password']),
            'auth_key'      => \Illuminate\Support\Str::random(32),
            'confirmed_at'  => now()->timestamp,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // Crear el perfil público del traveler
        $traveler = Traveler::create([
            'travelers_auth_id' => $auth->id,
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'],
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        $token = $auth->createToken('traveler-token')->plainTextToken;

        return response()->json([
            'message'  => 'Registro exitoso.',
            'token'    => $token,
            'traveler' => [
                'id'         => $traveler->id,
                'first_name' => $traveler->first_name,
                'last_name'  => $traveler->last_name,
                'email'      => $auth->email,
            ],
        ], 201);
    }

    /**
     * Inicio de sesión.
     * POST /api/auth/login
     */
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $auth = TravelerAuth::where('email', $data['email'])->first();

        if (! $auth || ! Hash::check($data['password'], $auth->password_hash)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales no son correctas.'],
            ]);
        }

        if ($auth->blocked_at) {
            return response()->json([
                'message' => 'Tu cuenta ha sido bloqueada. Contacta a soporte.',
            ], 403);
        }

        // Actualizar último login
        $auth->update([
            'last_login_at' => now()->timestamp,
            'last_login_ip' => $request->ip(),
            'updated_at'    => now(),
        ]);

        $traveler = $auth->traveler;
        $token    = $auth->createToken('traveler-token')->plainTextToken;

        return response()->json([
            'message'  => 'Inicio de sesión exitoso.',
            'token'    => $token,
            'traveler' => [
                'id'          => $traveler->id,
                'first_name'  => $traveler->first_name,
                'last_name'   => $traveler->last_name,
                'email'       => $auth->email,
                'public_photo' => $traveler->public_photo,
            ],
        ]);
    }

    /**
     * Cierre de sesión (revoca el token actual).
     * POST /api/auth/logout
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente.',
        ]);
    }

    /**
     * Datos del traveler autenticado.
     * GET /api/auth/me
     */
    public function me(Request $request): JsonResponse
    {
        $auth     = $request->user();
        $traveler = $auth->traveler;

        return response()->json([
            'traveler' => [
                'id'           => $traveler->id,
                'first_name'   => $traveler->first_name,
                'last_name'    => $traveler->last_name,
                'email'        => $auth->email,
                'public_photo' => $traveler->public_photo,
                'country'      => $traveler->country,
                'city'         => $traveler->city,
            ],
        ]);
    }
}
