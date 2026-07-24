<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentToTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();
            $table->enum('payment_status', ['unpaid', 'waiting', 'paid'])->default('unpaid');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_proof', 'payment_status']);
        });
    }
}