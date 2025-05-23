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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->ulid('id')->primary();
        
            $table->foreignId('reservasi_id')->constrained('reservasi')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
            $table->text('keterangan')->nullable(); // Alasan refund
        
            $table->decimal('total_pengembalian', 12, 2); // 85% dari total reservasi
        
            $table->string('bukti_pengembalian')->nullable(); // File bukti transfer dari admin
        
            $table->enum('status_pengembalian', [
                'menunggu_verifikasi', 'disetujui', 'selesai'
            ])->default('menunggu_verifikasi');
        
            $table->timestamp('refunded_at')->nullable(); // Waktu pengembalian disetujui
        
            $table->string('nomor_rekening')->nullable(); // Diisi user
            $table->string('nama_bank')->nullable();      // Diisi user (pakai select jika ingin distandarkan)
            $table->string('nama_pemilik')->nullable();   // Diisi user (pemilik rekening)
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
