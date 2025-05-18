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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_reservasi')->unique();
            $table->string('nama_pasien'); 
            $table->string('nik', 16);
            $table->text('alamat');
            $table->integer('umur'); 
            $table->decimal('tinggi_badan', 5, 2); 
            $table->decimal('berat_badan', 5, 2); 
            $table->text('keluhan'); 
            $table->date('tanggal_reservasi'); 
            $table->time('jam_reservasi'); 
            $table->string('no_telepon')->nullable(); 
            $table->enum('status', ['menunggu', 'disetujui'])->default('menunggu'); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
