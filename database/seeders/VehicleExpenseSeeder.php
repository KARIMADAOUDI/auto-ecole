<?php

namespace Database\Seeders;

use App\Models\VehicleExpense;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VehicleExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = Vehicle::all();

        if ($vehicles->isEmpty()) {
            return;
        }

        $expenses = [
            [
                'vehicle_id' => $vehicles->first()->id,
                'expense_date' => Carbon::now()->subDays(10),
                'amount' => 1500.00,
                'type' => 'maintenance',
                'description' => 'Vidange et changement des filtres',
                'invoice_number' => 'VEH-2024-001',
                'supplier' => 'Auto Service Plus',
                'notes' => 'Maintenance régulière',
            ],
            [
                'vehicle_id' => $vehicles->first()->id,
                'expense_date' => Carbon::now()->subDays(5),
                'amount' => 800.00,
                'type' => 'fuel',
                'description' => 'Plein d\'essence',
                'invoice_number' => 'VEH-2024-002',
                'supplier' => 'Shell',
                'notes' => 'Plein mensuel',
            ],
            [
                'vehicle_id' => $vehicles->last()->id,
                'expense_date' => Carbon::now()->subDays(2),
                'amount' => 2000.00,
                'type' => 'repair',
                'description' => 'Réparation freins',
                'invoice_number' => 'VEH-2024-003',
                'supplier' => 'Mécanique Express',
                'notes' => 'Remplacement des plaquettes de frein',
            ],
        ];

        foreach ($expenses as $expense) {
            VehicleExpense::create($expense);
        }
    }
} 