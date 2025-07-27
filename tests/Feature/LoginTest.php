<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Crea nuevo usuario
        User::factory()->create([
            'email' => 'donato@wewelcome.com',
            'password' => Hash::make('wewelcome2025'),
        ]);
    }

    public function test_login_success(): void
    {
        // Acceso correcto
        $response = $this->post('api/auth', [
            'email' => 'donato@wewelcome.com',
            'password' => 'wewelcome2025',
        ]);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'access_token',
                'token_type',
            ]);
    }

    public function test_login_validation_errors(): void
    {
        // Faltan campos
        $response = $this->post(action([AuthController::class, 'index']), [
            'email' => 'donato@wewelcome.com',
        ]);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
            ]);
    }

    public function test_login_invalid_credentials(): void
    {
        // Usuario no encontrado
        $response = $this->post(action([AuthController::class, 'index']), [
            'email' => 'donato@wewelcome.com',
            'password' => 'password',
        ]);
        $response->assertStatus(401)
            ->assertJsonStructure([
                'success',
                'message',
            ]);
    }
}
