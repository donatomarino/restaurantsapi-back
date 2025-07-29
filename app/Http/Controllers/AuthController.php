<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Exceptions\RequestValidationException;

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
                throw new ApiException('Inserta las credenciales indicadas en el placeholder', 401);
            }

            // Crear token
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Usuario autenticado correctamente',
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 200);
        } catch (ValidationException $e) {
            throw new RequestValidationException($e->errors(), $e->getCode());
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage(), $e->getCode());
        }
    }
}
