<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'payment_status')) {
                $table->string('payment_status')->default('waiting')->after('payment_method');
            }

            if (!Schema::hasColumn('transactions', 'payment_proof')) {
                $table->string('payment_proof')->nullable()->after('payment_status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('transactions', 'payment_status')) {
                $columnsToDrop[] = 'payment_status';
            }

            if (Schema::hasColumn('transactions', 'payment_proof')) {
                $columnsToDrop[] = 'payment_proof';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};