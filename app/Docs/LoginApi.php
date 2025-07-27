<?php

namespace App\Docs;

/**
 * @OA\Info(
 *     title="API Restaurantes - Donato Marino",
 *     version="1.0",
 *     contact=@OA\Contact(
 *         email="donato_8@icloud.com",
 *         name="Donato Marino",
 *     )
 * ),
 * @OA\Server(
 *    url=L5_SWAGGER_CONST_HOST,
 *   description="API Server"
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
   *   path="/api/auth",
   *   summary="Login",
   *   tags={"Login"},
   *   description="Iniciar sesión",
   *   @OA\RequestBody(
   *     required=true,
   *     @OA\JsonContent(
   *       required={"email", "password"},
   *       @OA\Property(property="email", type="string"),
   *       @OA\Property(property="password", type="string"),
   *     )
   *   ),
   *   @OA\Response(
   *     response=200,
   *     description="Autenticación exitosa"
   *   ),
   *   @OA\Response(
   *     response=401,
   *     description="Credenciales inválidas"
   *   ),
   *   @OA\Response(
   *     response=422,
   *     description="Todos los campos son obligatorios",
   *   ),
   *   @OA\Response(
   *     response=500,
   *     description="Error del servidor"
   *   )
   * )
   */
  function index() {}
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
