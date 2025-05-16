<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur admin s'il n'existe pas déjà
        if (!User::where('email', 'admin@autoecole.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@autoecole.com',
                'password' => Hash::make('password'),
            ]);
        }

        // Créer quelques utilisateurs de test s'il n'y en a pas déjà
        if (User::count() < 4) {
            User::factory(3)->create();
        }
    }
} 