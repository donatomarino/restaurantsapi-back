<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Login
     * @author Donato Marino
     * 
     * @param Request $request -> Contiene el email y password
     * 
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            // Comprobar campos
            $loginUserData = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ], [
                'email.required' => 'El correo es obligatorio',
                'password.required' => 'La password es obligatoria',
            ]);

            // Buscar usuario
            $user = User::where('email', $loginUserData['email'])->first();
            if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Credenciales inválidas'
                ], 401);
            }

            // Crear token
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Usuario autenticado correctamente',
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
