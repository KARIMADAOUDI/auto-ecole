<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $invoices = [
            [
                'invoice_number' => 'INV-2024-001',
                'supplier_name' => 'EDM',
                'invoice_type' => 'electricity',
                'amount' => 2500.00,
                'due_date' => Carbon::now()->addDays(30),
                'status' => 'pending',
                'payment_date' => null,
                'notes' => 'Facture d\'électricité mensuelle',
            ],
            [
                'invoice_number' => 'INV-2024-002',
                'supplier_name' => 'Maroc Telecom',
                'invoice_type' => 'internet',
                'amount' => 800.00,
                'due_date' => Carbon::now()->addDays(15),
                'status' => 'paid',
                'payment_date' => Carbon::now()->subDays(5),
                'notes' => 'Abonnement internet',
            ],
            [
                'invoice_number' => 'INV-2024-003',
                'supplier_name' => 'SNTL',
                'invoice_type' => 'rent',
                'amount' => 15000.00,
                'due_date' => Carbon::now()->addDays(7),
                'status' => 'pending',
                'payment_date' => null,
                'notes' => 'Loyer mensuel',
            ],
        ];

        foreach ($invoices as $invoice) {
            Invoice::create($invoice);
        }
    }
} 