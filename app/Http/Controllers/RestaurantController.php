<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Exceptions\ApiException;
use App\Exceptions\RequestValidationException;

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
            ], 200);
        } catch (\Exception $e) {
            throw new ApiException('Ocurrió un error al sacar los restaurantes', 500);
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
                'phone' => 'required|phone:ES',
            ], [
                'name.required' => 'El nombre es obligatorio',
                'address.required' => 'La dirección es obligatoria',
                'phone.required' => 'El telefono es obligatorio',
                'phone.phone' => 'El teléfono debe ser un número español válido',
            ]);

            // Verificar si el restaurante ya existe
            $restaurantExists = Restaurant::withTrashed()
                ->where('name', $newRestaurantData['name'])
                ->where('address', $newRestaurantData['address'])
                ->exists();

            // Si ya existe, devuelve un error
            if ($restaurantExists) {
                throw new ApiException('El restaurante ya se encuentra registrado', 409);
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
            ], 201);
        } catch (ApiException $e) {
            throw $e;
        } catch (ValidationException $e) {
            throw new RequestValidationException($e->errors());
        } catch (\Exception $e) {
            throw new ApiException('Error al crear el restaurante', 500);
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
            // Verificar si la solicitud es PUT o PATCH
            $isPut = $request->isMethod('put');

            // Validar los campos obligatorios según el método
            $validatedData = $request->validate([
                'name' => $isPut ? 'required|string' : 'sometimes|required|string',
                'address' => $isPut ? 'required|string' : 'sometimes|required|string',
                'phone' => $isPut ? 'required|phone:ES' : 'sometimes|required|phone:ES',
            ], [
                'name.required' => 'El nombre es obligatorio',
                'address.required' => 'La dirección es obligatoria',
                'phone.required' => 'El telefono es obligatorio',
                'phone.phone' => 'El teléfono debe ser un número español válido',
            ]);

            // Buscar por id
            $restaurant = Restaurant::findOrFail($id);

            // Verificar si por lo menos un campo ha sido modificado
            $hasChanges = false;
            foreach ($validatedData as $key => $value) {
                if ($restaurant->$key !== $value) {
                    $hasChanges = true;
                    break;
                }
            }

            // Si no hay cambios, devuelve un error
            if (!$hasChanges) {
                throw new ApiException('Debes modificar al menos un campo para actualizar el restaurante', 422);
            }

            // Verificar si el restaurante ya existe, excepto el actual
            $checkName = $validatedData['name'] ?? $restaurant->name;
            $checkAddress = $validatedData['address'] ?? $restaurant->address;
            $restaurantExists = Restaurant::withTrashed()
                ->where('name', $checkName)
                ->where('address', $checkAddress)
                ->where('id', '!=', $id)
                ->exists();

            // Si ya existe, devuelve un error
            if ($restaurantExists) {
                throw new ApiException('El restaurante ya se encuentra registrado', 409);
            }

            // Actualizar todos los campos
            $restaurant->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Restaurante actualizado correctamente'
            ], 200);
        } catch (ApiException $e) {
            throw $e;
        } catch (ValidationException $e) {
            throw new RequestValidationException($e->errors());
        } catch (ModelNotFoundException $e) {
            throw new ApiException('Restaurante no encontrado', 404);
        } catch (\Exception $e) {
            throw new ApiException('Ocurrió un error al actualizar el restaurante', 500);
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

            return response(null, 204);
        } catch (ModelNotFoundException $e) {
            throw new ApiException('Restaurante no encontrado', 404);
        } catch (\Exception $e) {
            throw new ApiException('Ocurrió un error al eliminar el restaurante', 500);
        }
    }
}
