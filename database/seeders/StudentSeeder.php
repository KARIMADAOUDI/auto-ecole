<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'first_name' => 'Sara',
                'last_name' => 'Benali',
                'email' => 'sara.benali@email.com',
                'phone' => '0645678901',
                'address' => '123 Rue Hassan II',
                'city' => 'Casablanca',
                'postal_code' => '20000',
                'birth_date' => Carbon::parse('2000-05-15'),
                'license_type' => 'B',
                'is_active' => true,
                'total_amount' => 2500.00,
                'paid_amount' => 0.00,
                'is_paid' => false,
            ],
            [
                'first_name' => 'Youssef',
                'last_name' => 'El Fathi',
                'email' => 'youssef.elfathi@email.com',
                'phone' => '0656789012',
                'address' => '456 Avenue Mohammed V',
                'city' => 'Rabat',
                'postal_code' => '10000',
                'birth_date' => Carbon::parse('1998-08-22'),
                'license_type' => 'A',
                'is_active' => true,
                'total_amount' => 2500.00,
                'paid_amount' => 0.00,
                'is_paid' => false,
            ],
            [
                'first_name' => 'Laila',
                'last_name' => 'Mourad',
                'email' => 'laila.mourad@email.com',
                'phone' => '0667890123',
                'address' => '789 Boulevard Anfa',
                'city' => 'Casablanca',
                'postal_code' => '20000',
                'birth_date' => Carbon::parse('2002-03-10'),
                'license_type' => 'B',
                'is_active' => true,
                'total_amount' => 2500.00,
                'paid_amount' => 0.00,
                'is_paid' => false,
            ],
        ];

        foreach ($students as $student) {
            // Vérifier si l'élève existe déjà
            if (!Student::where('email', $student['email'])->exists()) {
                Student::create($student);
            }
        }
    }
} 