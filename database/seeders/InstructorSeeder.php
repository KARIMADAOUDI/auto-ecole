<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = [
            [
                'first_name' => 'Mohammed',
                'last_name' => 'Alami',
                'email' => 'mohammed.alami@autoecole.com',
                'phone' => '0612345678',
                'birth_date' => Carbon::parse('1985-06-15'),
                'address' => '15 Rue Mohammed V',
                'city' => 'Casablanca',
                'postal_code' => '20000',
                'license_number' => 'INS123456',
                'is_active' => true,
                'status' => 'active',
            ],
            [
                'first_name' => 'Fatima',
                'last_name' => 'Benjelloun',
                'email' => 'fatima.benjelloun@autoecole.com',
                'phone' => '0623456789',
                'birth_date' => Carbon::parse('1990-03-22'),
                'address' => '28 Avenue Hassan II',
                'city' => 'Casablanca',
                'postal_code' => '20000',
                'license_number' => 'INS789012',
                'is_active' => true,
                'status' => 'active',
            ],
            [
                'first_name' => 'Karim',
                'last_name' => 'El Fathi',
                'email' => 'karim.elfathi@autoecole.com',
                'phone' => '0634567890',
                'birth_date' => Carbon::parse('1988-11-10'),
                'address' => '45 Boulevard Anfa',
                'city' => 'Casablanca',
                'postal_code' => '20000',
                'license_number' => 'INS345678',
                'is_active' => true,
                'status' => 'active',
            ],
        ];

        foreach ($instructors as $instructor) {
            // Vérifier si l'instructeur existe déjà
            if (!Instructor::where('email', $instructor['email'])->exists() && 
                !Instructor::where('license_number', $instructor['license_number'])->exists()) {
                Instructor::create($instructor);
            }
        }
    }
} 