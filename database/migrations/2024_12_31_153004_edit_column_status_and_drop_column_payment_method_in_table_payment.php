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
        Schema::table('payments', function (Blueprint $table) {
            // Ubah kolom payment_method dari enum menjadi string
            $table->string('payment_method')->change();

            // Ubah kolom status enum menjadi enum baru dengan nilai paid dan unpaid
            $table->enum('status', ['paid', 'unpaid'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Kembalikan kolom payment_method menjadi enum jika ingin rollback
            $table->enum('payment_method', ['bank_transfer', 'credit_card', 'paypal'])->change();

            // Kembalikan kolom status menjadi enum dengan nilai original (pending, completed, failed)
            $table->enum('status', ['pending', 'completed', 'failed'])->change();
        });
    }
};
