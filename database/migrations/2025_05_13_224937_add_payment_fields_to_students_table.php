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
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'paid_amount')) {
                $table->decimal('paid_amount', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('students', 'is_paid')) {
                $table->boolean('is_paid')->default(false);
            }
            if (!Schema::hasColumn('students', 'total_amount')) {
                $table->decimal('total_amount', 10, 2)->default(2500);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['paid_amount', 'is_paid', 'total_amount']);
        });
    }
};
