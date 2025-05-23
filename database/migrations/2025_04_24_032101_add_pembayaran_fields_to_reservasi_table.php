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
        Schema::table('reservasi', function (Blueprint $table) {
            //
            $table->string('bukti_pembayaran')->after('total_reservasi')->nullable(); // path bukti bayar
            $table->timestamp('batas_waktu_reservasi')->after('bukti_pembayaran')->nullable(); // buat otomatis expired
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            //
        });
    }
};
