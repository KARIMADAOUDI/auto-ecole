<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('personal_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->nullable()->constrained()->onDelete('set null');
            $table->date('expense_date');
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['salary', 'bonus', 'training', 'equipment', 'office', 'other']);
            $table->string('description');
            $table->string('invoice_number')->nullable();
            $table->string('supplier')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personal_expenses');
    }
}; 