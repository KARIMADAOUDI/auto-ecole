<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Supprimer la relation avec les élèves si elle existe
            if (Schema::hasColumn('invoices', 'student_id')) {
                $table->dropForeign(['student_id']);
                $table->dropColumn('student_id');
            }

            // Ajouter les colonnes nécessaires pour les factures de l'auto-école
            if (!Schema::hasColumn('invoices', 'invoice_number')) {
                $table->string('invoice_number')->unique();
            }
            if (!Schema::hasColumn('invoices', 'supplier_name')) {
                $table->string('supplier_name');
            }
            if (!Schema::hasColumn('invoices', 'invoice_type')) {
                $table->string('invoice_type'); // electricity, credit, rent, etc.
            }
            if (!Schema::hasColumn('invoices', 'amount')) {
                $table->decimal('amount', 10, 2);
            }
            if (!Schema::hasColumn('invoices', 'due_date')) {
                $table->date('due_date');
            }
            if (!Schema::hasColumn('invoices', 'status')) {
                $table->string('status')->default('pending'); // pending, paid, overdue
            }
            if (!Schema::hasColumn('invoices', 'payment_date')) {
                $table->date('payment_date')->nullable();
            }
            if (!Schema::hasColumn('invoices', 'notes')) {
                $table->text('notes')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Supprimer les colonnes ajoutées
            $table->dropColumn([
                'invoice_number',
                'supplier_name',
                'invoice_type',
                'amount',
                'due_date',
                'status',
                'payment_date',
                'notes'
            ]);
        });
    }
};
