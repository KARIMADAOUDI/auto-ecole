<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Student;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mettre à jour tous les élèves existants
        Student::where('total_amount', 0)->update(['total_amount' => 2500]);

        // Modifier la colonne pour définir la valeur par défaut
        Schema::table('students', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->default(2500)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->default(0)->change();
        });
    }
};
