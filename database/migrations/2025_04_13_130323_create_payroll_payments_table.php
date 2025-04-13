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
        Schema::create('payroll_payments', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->foreignId('payroll_id')->constrained()->onDelete('cascade');  // Reference to payroll
            $table->decimal('amount', 10, 2);  // Amount paid
            $table->string('voucher')->nullable();  // Date of payment
            $table->date('payment_date');  // Date of payment
            $table->timestamps();  // Created at, updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_payments');
    }
};
