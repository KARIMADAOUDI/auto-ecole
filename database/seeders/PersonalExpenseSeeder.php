<?php

namespace Database\Seeders;

use App\Models\PersonalExpense;
use App\Models\Instructor;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PersonalExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = Instructor::all();

        if ($instructors->isEmpty()) {
            return;
        }

        $expenses = [
            [
                'instructor_id' => $instructors->first()->id,
                'expense_date' => Carbon::now()->subDays(15),
                'amount' => 5000.00,
                'type' => 'salary',
                'description' => 'Salaire mensuel',
                'invoice_number' => 'PER-2024-001',
                'supplier' => null,
                'notes' => 'Salaire de base',
            ],
            [
                'instructor_id' => $instructors->first()->id,
                'expense_date' => Carbon::now()->subDays(7),
                'amount' => 1000.00,
                'type' => 'bonus',
                'description' => 'Prime de performance',
                'invoice_number' => 'PER-2024-002',
                'supplier' => null,
                'notes' => 'Bonus mensuel',
            ],
            [
                'instructor_id' => $instructors->last()->id,
                'expense_date' => Carbon::now()->subDays(3),
                'amount' => 2000.00,
                'type' => 'training',
                'description' => 'Formation continue',
                'invoice_number' => 'PER-2024-003',
                'supplier' => 'Centre de Formation Auto',
                'notes' => 'Formation sur les nouvelles réglementations',
            ],
        ];

        foreach ($expenses as $expense) {
            PersonalExpense::create($expense);
        }
    }
} 