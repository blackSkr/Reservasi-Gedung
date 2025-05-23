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
            $table->foreignId('fasilitas_id')->nullable()->after('user_id');
            $table->string('catatan')->nullable()->after('waktu_selesai');
            $table->string('total_reservasi')->nullable()->after('catatan'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('fasilitas_id');
        Schema::dropColumns('catatan');
        Schema::dropColumns('total_reservasi');
    }
};
