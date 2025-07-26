<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\RestaurantController;
use App\Models\Restaurant;
use App\Models\User;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        // Crea usuario y genera token
        $user = User::factory()->create();
        $this->token = $user->createToken('auth_token')->plainTextToken;
        // Crea nuevos restaurantes aleatorios
        Restaurant::factory(10)->create();
    }

    public function test_get_restaurants_success()
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

    public function test_create_restaurant_success()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('api/restaurants', [
            'name' => 'Nuevo Restaurante',
            'address' => 'Calle Falsa 123',
            'phone' => '123456789',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
            ]);
    }

    public function test_create_restaurant_existing()
    {
        $restaurant = Restaurant::factory()->create([
            'name' => 'Restaurante Existente',
            'address' => 'Calle Existente 456',
            'phone' => '987654321',
        ]);

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
            ]);
    }

    public function test_create_restaurant_validation_errors()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('api/restaurants', [
            'address' => 'Calle Sin Nombre',
            'phone' => '123456789',
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
            ]);
    }
}
