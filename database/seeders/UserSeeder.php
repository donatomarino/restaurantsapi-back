<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Franao Marino',
            'email' => 'don5ssro@wewelcome.com',
            'password' => Hash::make('wewelcome2025')
        ]);
    }
}
