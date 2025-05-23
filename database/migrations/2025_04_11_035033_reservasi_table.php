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
        
        Schema::create('reservasi', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->foreignUlid('gedung_id');
            $table->foreignId   ('user_id')->nullable();
            $table->string('nominal', 35);
            $table->time('waktu_reservasi');
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai',0)->nullable();
            $table->string('status', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
