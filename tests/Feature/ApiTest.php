<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class ApiTest extends TestCase
{
    public function test_login()
    {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        
        // Acceso correcto
        $response = $this->post('/api/auth', [
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

        // Faltan campos
        $response = $this->post('/api/auth', [
            'email' => 'donato@wewelcome.com',
        ]);
        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
            ]);

        // Usuario no encontrado
        $response = $this->post('/api/auth', [
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
