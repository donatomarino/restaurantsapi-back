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
   *  path="/api/restaurants",
   *  summary="Listar",
   *  tags={"Restaurantes"},
   *  security={{"bearerAuth":{}}},
   *  @OA\Response(
   *    response=200,
   *    description="Listar todos los restaurantes"
   *  ),
   *  @OA\Response(
   *    response=500,
   *    description="Error del servidor"
   *  )
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
   *     response=200,
   *     description="Restaurante creado"
   *   ),
   *   @OA\Response(
   *     response=409,
   *     description="Restaurante ya existe"
   *   ),
   *   @OA\Response(
   *     response=500,
   *     description="Error del servidor"
   *   )
   * )
   */
  public function store() {}

  /**
   * @OA\Put(
   *   path="/api/restaurants/{id}",
   *   summary="Actualizar",
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
   *     @OA\JsonContent(
   *       @OA\Property(property="name", type="string"),
   *       @OA\Property(property="address", type="string"),
   *       @OA\Property(property="phone", type="string")
   *     )
   *   ),
   *   @OA\Response(
   *     response=200,
   *     description="Restaurante actualizado"
   *   ),
   *   @OA\Response(
   *     response=404,
   *     description="Restaurante no encontrado"
   *   ),
   *   @OA\Response(
   *     response=500,
   *     description="Error del servidor"
   *   )
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
   *     description="Restaurante eliminado"
   *   ),
   *   @OA\Response(
   *     response=404,
   *     description="Restaurante no encontrado"
   *   ),
   *   @OA\Response(
   *     response=500,
   *     description="Error del servidor"
   *   )
   * )
   */
  public function destroy() {}
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
