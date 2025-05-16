<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            return;
        }

        $payments = [
            [
                'student_id' => $students->first()->id,
                'amount' => 1000.00,
                'payment_date' => Carbon::now()->subDays(30),
                'payment_method' => 'cash',
                'notes' => 'Premier versement',
            ],
            [
                'student_id' => $students->first()->id,
                'amount' => 500.00,
                'payment_date' => Carbon::now()->subDays(15),
                'payment_method' => 'bank_transfer',
                'notes' => 'Deuxième versement',
            ],
            [
                'student_id' => $students->last()->id,
                'amount' => 1500.00,
                'payment_date' => Carbon::now()->subDays(7),
                'payment_method' => 'credit_card',
                'notes' => 'Paiement complet',
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
} 