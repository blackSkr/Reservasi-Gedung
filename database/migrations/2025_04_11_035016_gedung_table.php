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
        //
        Schema::create('gedung', function (Blueprint $table) {
            $table->ulid('id')->primary();
            // $table->ulid('id')->primary()->autoIncrement();
            $table->string('nama_gedung', 50);
            $table->string('tipe_gedung', 35); 
            $table->string('foto_gedung', 255); 
            $table->float('harga' ); 
            $table->integer('kapasitas'); 
            $table->string('fasilitas', 255); 
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
