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
        Schema::create('profil_perusahaan', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nama_perusahaan')->nullable();
            $table->string('email')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('alamat_jalan')->nullable();
            $table->string('alamat_gedung')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('qr_pembayaran')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('Status')->default('Tidak Aktif')->nullable();
            $table->timestamp('update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_perusahan');
    }
};
