<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Restaurant;
use App\Models\User;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    protected $token;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Crea usuario y genera token
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('auth_token')->plainTextToken;
        // Crea nuevos restaurantes aleatorios
        Restaurant::factory(5)->create();
    }

    // ============== GET TESTS ============== 
    // Obtener todos los restaurantes correctamente
    public function test_get_restaurants_success(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('api/restaurants');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'address',
                        'phone',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }



    // ============== ADD TESTS ==============
    // Crear restaurante correctamente
    public function test_create_restaurant_success(): void
    {
        $data = [
            'name' => 'Nuevo Restaurante',
            'address' => 'Calle Falsa 123',
            'phone' => '988456789',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('api/restaurants', $data);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
            ]);

        $this->assertDatabaseHas('restaurants', $data);
    }

    // Crear restaurante con nombre y dirección existente
    public function test_create_restaurant_existing(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('api/restaurants', [
            'name' => $restaurant->name,
            'address' => $restaurant->address,
            'phone' => $restaurant->phone,
        ]);

        $response->assertStatus(409)
            ->assertJsonStructure([
                'success',
                'message',
                'error'
            ]);
    }

    // Crear restaurante con validación de campos faltantes
    public function test_create_restaurant_validation_errors(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('api/restaurants', [
            'address' => 'Calle Sin Nombre',
            'phone' => '697873748',
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'error'
            ]);
    }


    // ============== UPDATE TESTS ==============
    // Actualizar restaurante por completo correctamente
    public function test_update_restaurant_success(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->put('api/restaurants/' . $restaurant->id, [
            'name' => 'Update Restaurant',
            'address' => 'Update Address',
            'phone' => '659456789'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
            ]);
    }

    // Actualizar restaurante con nombre y dirección ya existentes
    public function test_update_restaurant_existing(): void
    {
        $restaurant = Restaurant::factory()->create();
        $existingRestaurant = Restaurant::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->put('api/restaurants/' . $restaurant->id, [
            'name' => $existingRestaurant->name,
            'address' => $existingRestaurant->address,
            'phone' => $restaurant->phone,
        ]);
        $response->assertStatus(409)
            ->assertJsonStructure([
                'success',
                'message',
                'error'
            ]);
    }

    // Actualizar restaurante sin modificar campos
    public function test_update_restaurant_no_changes(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->put('api/restaurants/' . $restaurant->id, [
            'name' => $restaurant->name,
            'address' => $restaurant->address,
            'phone' => $restaurant->phone,
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'error'
            ]);
    }

    // Actualizar restaurante que no existe
    public function test_update_restaurant_not_existing(): void
    {
        Restaurant::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->put('api/restaurants/493', [
            'name' => 'Restaurante Inexistente',
            'address' => 'Direccion Inexistente',
            'phone' => '673456789',
        ]);

        $response->assertStatus(404)
            ->assertJsonStructure([
                'success',
                'message',
                'error'
            ]);
    }

    // Actualizar solamente un campo
    public function test_update_only_phone_of_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->patch('api/restaurants/' . $restaurant->id, [
            'phone' => '697651199'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
            ]);
    }



    // ============== DELETE TESTS ==============
    // Eliminar restaurante correctamente
    public function test_delete_restaurant_success(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->delete('api/restaurants/' . $restaurant->id);

        $response->assertStatus(204);

        $this->assertSoftDeleted('restaurants', [
            'id' => $restaurant->id,
        ]);
    }

    // Eliminar restaurante que no existe
    public function test_delete_restaurant_not_found(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->delete('api/restaurants/20');

        $response->assertStatus(404)
            ->assertJsonStructure([
                'success',
                'message',
                'error'
            ]);
    }
}
