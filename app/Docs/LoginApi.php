<?php

namespace App\Docs;

/**
 * @OA\Info(
 *     title="API Restaurantes - Donato Marino",
 *     version="1.0",
 *     contact=@OA\Contact(
 *         email="donato_8@icloud.com",
 *         name="Donato Marino"
 *     )
 * ),
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * ),
 * @OA\Tag(
 *     name="Login",
 *     description="Iniciar sesión"
 * )
 */
class LoginApi
{
    /**
     * @OA\Post(
     *     path="/api/auth",
     *     summary="Login",
     *     tags={"Login"},
     *     description="Iniciar sesión",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Autenticación exitosa",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="access_token", type="string"),
     *             @OA\Property(property="token_type", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciales inválidas",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="error", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Errores de validación",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="object", example={
     *                 "email": {"El correo es obligatorio"},
     *                 "password": {"La password es obligatoria"}
     *             }),
     *             @OA\Property(property="error", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=429,
     *         description="Demasiadas solicitudes (Rate Limiting)",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Demasiadas solicitudes, intenta más tarde"),
     *             @OA\Property(property="error", type="boolean", example=true)
     *         ),
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error del servidor"
     *     )
     * )
     */
    public function index() {}
}

/**
 * @OA\Schema(
 *     schema="Restaurant",
 *     type="object",
 *     required={"name", "address", "phone"},
 *     @OA\Property(property="id", type="integer", readOnly=true),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="address", type="string"),
 *     @OA\Property(property="phone", type="string")
 * )
 */
