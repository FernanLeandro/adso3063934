<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Login del usuario y generación de token
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'string']
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Credenciales inválidas',
                ], 401);
            }

            $token = Str::random(80);
            
            // Guardar en cache (válido durante 2 horas)
            cache()->put('api_token_' . $token, $user->id, now()->addHours(2));

            return response()->json([
                'message' => 'Inicio de sesión exitoso ✅',
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'fullname' => $user->fullname,
                    'role' => $user->role
                ]
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Error en la solicitud',
                'errors' => $e->errors()
            ], 400);
        }
    }

    /**
     * Logout del usuario
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Token no proporcionado',
            ], 401);
        }

        // Validar que el token existe en cache
        $userId = cache()->get('api_token_' . $token);
        
        if (!$userId) {
            return response()->json([
                'message' => 'Token inválido o expirado',
            ], 401);
        }

        // Eliminar el token del cache
        cache()->forget('api_token_' . $token);

        return response()->json([
            'message' => 'Sesión cerrada exitosamente ✅'
        ], 200);
    }
}