<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'brand' => 'Renault',
                'model' => 'Clio',
                'year' => 2020,
                'registration_number' => '12345-A-6',
                'type' => 'manual',
                'status' => 'available',
                'color' => 'Blanc',
            ],
            [
                'brand' => 'Peugeot',
                'model' => '208',
                'year' => 2021,
                'registration_number' => '23456-B-6',
                'type' => 'automatic',
                'status' => 'available',
                'color' => 'Gris',
            ],
            [
                'brand' => 'Citroën',
                'model' => 'C3',
                'year' => 2019,
                'registration_number' => '34567-C-6',
                'type' => 'manual',
                'status' => 'maintenance',
                'color' => 'Rouge',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            // Vérifier si le véhicule existe déjà
            if (!Vehicle::where('registration_number', $vehicle['registration_number'])->exists()) {
                Vehicle::create($vehicle);
            }
        }
    }
} 