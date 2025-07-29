<?php

namespace App\Docs;

/**
 * @OA\Tag(
 *     name="Restaurantes",
 *     description="Operaciones relacionadas con restaurantes"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class RestaurantApi
{
  /**
   * @OA\Get(
   *   path="/api/restaurants",
   *   summary="Listar",
   *   tags={"Restaurantes"},
   *   security={{"bearerAuth":{}}},
   *   @OA\Response(
   *     response=200,
   *     description="Listar todos los restaurantes",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean"),
   *       @OA\Property(property="message", type="string", example="Restaurantes obtenidos correctamente"),
   *       @OA\Property(property="data", type="array", @OA\Items(
   *         @OA\Property(property="id", type="integer"),
   *         @OA\Property(property="name", type="string"),
   *         @OA\Property(property="address", type="string"),
   *         @OA\Property(property="phone", type="string")
   *       ))
   *     )
   *   ),
   *   @OA\Response(response=500, description="Error del servidor")
   * )
   */
  public function index() {}

  /**
   * @OA\Post(
   *   path="/api/restaurants",
   *   summary="Añadir",
   *   tags={"Restaurantes"},
   *   security={{"bearerAuth":{}}},
   *   @OA\RequestBody(
   *     required=true,
   *     @OA\JsonContent(
   *       required={"name", "address", "phone"},
   *       @OA\Property(property="name", type="string"),
   *       @OA\Property(property="address", type="string"),
   *       @OA\Property(property="phone", type="string")
   *     )
   *   ),
   *   @OA\Response(
   *     response=201,
   *     description="Restaurante creado",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean"),
   *       @OA\Property(property="message", type="string", example="Restaurante añadido correctamente")
   *     )
   *   ),
   *   @OA\Response(
   *     response=409,
   *     description="Restaurante ya existe",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=false),
   *       @OA\Property(property="message", type="string", example="El restaurante ya existe"),
   *       @OA\Property(property="error", type="boolean", example=true)
   *     )
   *   ),
   *   @OA\Response(
   *     response=422,
   *     description="Todos los campos son obligatorios",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=false),
   *       @OA\Property(property="message", type="object", example={
   *         "name": {"El nombre es obligatorio"},
   *         "address": {"La dirección es obligatoria"},
   *         "phone": {"El teléfono es obligatorio"}
   *       }),
   *       @OA\Property(property="error", type="boolean", example=true)
   *     )
   *   ),
   *   @OA\Response(response=500, description="Error del servidor")
   * )
   */
  public function store() {}

  /**
   * @OA\Put(
   *   path="/api/restaurants/{id}",
   *   summary="Actualizar completamente",
   *   tags={"Restaurantes"},
   *   security={{"bearerAuth":{}}},
   *   @OA\Parameter(
   *     name="id",
   *     in="path",
   *     required=true,
   *     description="ID del restaurante",
   *     @OA\Schema(type="integer")
   *   ),
   *   @OA\RequestBody(
   *     required=true,
   *     @OA\JsonContent(
   *       required={"name","address","phone"},
   *       @OA\Property(property="name", type="string"),
   *       @OA\Property(property="address", type="string"),
   *       @OA\Property(property="phone", type="string")
   *     )
   *   ),
   *   @OA\Response(
   *     response=200,
   *     description="Restaurante actualizado",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean"),
   *       @OA\Property(property="message", type="string")
   *     )
   *   ),
   *   @OA\Response(
   *     response=404,
   *     description="Restaurante no encontrado",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=false),
   *       @OA\Property(property="message", type="string", example="Restaurante no encontrado"),
   *       @OA\Property(property="error", type="boolean", example=true)
   *     )
   *   ),
   *   @OA\Response(
   *     response=409,
   *     description="Restaurante ya existe",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=false),
   *       @OA\Property(property="message", type="string", example="El restaurante ya existe"),
   *       @OA\Property(property="error", type="boolean", example=true)
   *     )
   *   ),
   *   @OA\Response(
   *     response=422,
   *     description="Errores de validaciones",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=false),
   *       @OA\Property(property="message", type="object", example={
   *         "name": {"El nombre es obligatorio"},
   *         "address": {"La dirección es obligatoria"},
   *         "phone": {"El teléfono es obligatorio"}
   *       }),
   *       @OA\Property(property="error", type="boolean", example=true)
   *     )
   *   ),
   *   @OA\Response(response=500, description="Error del servidor")
   * )
   *
   * @OA\Patch(
   *   path="/api/restaurants/{id}",
   *   summary="Actualizar parcialmente",
   *   tags={"Restaurantes"},
   *   security={{"bearerAuth":{}}},
   *   @OA\Parameter(
   *     name="id",
   *     in="path",
   *     required=true,
   *     description="ID del restaurante",
   *     @OA\Schema(type="integer")
   *   ),
   *   @OA\RequestBody(
   *     required=true,
   *     @OA\JsonContent(
   *       @OA\Property(property="name", type="string"),
   *       @OA\Property(property="address", type="string"),
   *       @OA\Property(property="phone", type="string")
   *     )
   *   ),
   *   @OA\Response(
   *     response=200,
   *     description="Restaurante actualizado",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=true),
   *       @OA\Property(property="message", type="string", example="Restaurante actualizado correctamente")
   *     )
   *   ),
   *   @OA\Response(
   *     response=404,
   *     description="Restaurante no encontrado",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=false),
   *       @OA\Property(property="message", type="string", example="Restaurante no encontrado"),
   *       @OA\Property(property="error", type="boolean", example=true)
   *     )
   *   ),
   *   @OA\Response(
   *     response=409,
   *     description="Restaurante ya existe",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=false),
   *       @OA\Property(property="message", type="string", example="El restaurante ya existe"),
   *       @OA\Property(property="error", type="boolean", example=true)
   *     )
   *   ),
   *   @OA\Response(
   *     response=422,
   *     description="Errores de validaciones",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=false),
   *       @OA\Property(property="message", type="object", example={
   *         "name": {"No se puede dejar vacío"},
   *         "address": {"No se puede dejar vacío"},
   *         "phone": {"El teléfono no es válido"}
   *       }),
   *       @OA\Property(property="error", type="boolean", example=true)
   *     )
   *   ),
   *   @OA\Response(response=500, description="Error del servidor")
   * )
   */
  public function update() {}

  /**
   * @OA\Delete(
   *   path="/api/restaurants/{id}",
   *   summary="Eliminar",
   *   tags={"Restaurantes"},
   *   security={{"bearerAuth":{}}},
   *   @OA\Parameter(
   *     name="id",
   *     in="path",
   *     required=true,
   *     description="ID del restaurante",
   *     @OA\Schema(type="integer")
   *   ),
   *   @OA\Response(
   *     response=200,
   *     description="Restaurante eliminado",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=true),
   *       @OA\Property(property="message", type="string", example="Restaurante eliminado correctamente"),
   *       @OA\Property(property="error", type="boolean", example=false)
   *     )
   *   ),
   *   @OA\Response(
   *     response=404,
   *     description="Restaurante no encontrado",
   *     @OA\JsonContent(
   *       @OA\Property(property="success", type="boolean", example=false),
   *       @OA\Property(property="message", type="string", example="Restaurante no encontrado"),
   *       @OA\Property(property="error", type="boolean", example=true)
   *     )
   *   ),
   *   @OA\Response(response=500, description="Error del servidor")
   * )
   */
  public function destroy() {}
}

/**
 * @OA\Schema(
 *   schema="Restaurant",
 *   type="object",
 *   required={"name", "address", "phone"},
 *   @OA\Property(property="id", type="integer", readOnly=true),
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="address", type="string"),
 *   @OA\Property(property="phone", type="string")
 * )
 */
