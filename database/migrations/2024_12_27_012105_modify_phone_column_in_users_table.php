<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPhoneColumnInUsersTable extends Migration
{
    /**
     * Jalankan migrasi untuk memperbarui kolom 'phone' di tabel 'users'.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->change(); // Ubah panjang kolom phone menjadi 20
        });
    }

    /**
     * Membalikkan migrasi untuk mengubah kolom 'phone' ke ukuran semula.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 15)->change(); // Kembalikan panjang ke 15 (atau sesuai kebutuhan)
        });
    }
}
