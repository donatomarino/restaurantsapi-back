<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RestaurantController extends Controller
{
    /**
     * Listar todos 
     * @author Donato Marino 
     *      
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $restaurants = Restaurant::all();
            return response()->json([
                'success' => true,
                'message' => 'Restaurantes obtenidos correctamente',
                'data' => $restaurants
            ]);
        } catch (\Exception $e) {
            Log::error('Error al sacar restaurantes: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al sacar los restaurantes'
            ], 500);
        }
    }

    /**
     * Añadir nuevo
     * @author Donato Marino
     * 
     * @param Request $request -> Contiene el nombre, dirección y telefono.
     * 
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Comprobar que se pasen todos los campos obligatorios
            $newRestaurantData = $request->validate([
                'name' => 'required|string',
                'address' => 'required|string',
                'phone' => 'required|string',
            ], [
                'name.required' => 'El nombre es obligatorio',
                'address.required' => 'La dirección es obligatoria',
                'phone.required' => 'El telefono es obligatorio'
            ]);

            // Verificar si el restaurante ya existe
            $restaurantExists = $this->restaurantExists($newRestaurantData);

            // Si ya existe, devuelve un error
            if ($restaurantExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'El restaurante ya se encuentra registrado',
                    'error' => true
                ], 409);
            }

            // Si no existe, lo añade
            Restaurant::create([
                'name' => $newRestaurantData['name'],
                'address' => $newRestaurantData['address'],
                'phone' => $newRestaurantData['phone']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Restaurante añadido correctamente',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors(),
                'error' => true
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error al crear restaurante: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al registrar el restaurante'
            ], 500);
        }
    }

    /**
     * Actualizar
     * @author Donato Marino 
     * 
     * @param Request $request -> Contiene los campos a actualizar
     * @param $id -> id del restaurante
     * 
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Buscar por id
            $restaurant = Restaurant::findOrFail($id);

            // Verificar si por lo menos un campo ha sido modificado
            $noChanges = $request->name === $restaurant['name'] &&
                $request->address === $restaurant['address'] &&
                $request->phone === $restaurant['phone'];

            if ($noChanges) {
                return response()->json([
                    'success' => false,
                    'message' => 'Debes modificar al menos un campo para actualizar el restaurante',
                    'error' => true
                ], 422);
            }

            // Verificar si el restaurante ya existe
            $restaurantExists = $this->restaurantExists($request->only(['name', 'address']));

            // Si ya existe, devuelve un error
            if ($restaurantExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'El restaurante ya se encuentra registrado',
                    'error' => true
                ], 409);
            }

            // Actualizar los campos
            $restaurant->update($request->only(['name', 'address', 'phone']));

            return response()->json([
                'success' => true,
                'message' => 'Restaurante actualizado correctamente'
            ]);
        } catch (ModelNotFoundException $e) {
            Log::error('Error al buscar el restaurante: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado',
                'error' => true
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error al actualizar restaurante: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar el restaurante'
            ], 500);
        }
    }

    /**
     * Eliminar
     * @author Donato Marino 
     * 
     * @param $id -> Contiene id del restaurante
     * 
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            // Buscar y eliminar el restaurante
            $restaurant = Restaurant::findOrFail($id);
            $restaurant->delete();

            return response()->json([
                'success' => true,
                'message' => 'Restaurante eliminado correctamente'
            ]);
        } catch (ModelNotFoundException $e) {
            Log::error('Error al buscar el restaurante: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Restaurante no encontrado',
                'error' => true
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error al eliminar el restaurante: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al eliminar el restaurante'
            ]);
        }
    }

    /**
     * Verifica si el restaurante ya existe
     * @author Donato Marino
     * 
     * @param array $restaurant -> Contiene el nombre y dirección del restaurante
     * 
     * @return JsonResponse|bool
     */
    private function restaurantExists(array $restaurant): bool
    {
        return Restaurant::withTrashed()
            ->where('name', $restaurant['name'])
            ->where('address', $restaurant['address'])
            ->exists();
    }
}
