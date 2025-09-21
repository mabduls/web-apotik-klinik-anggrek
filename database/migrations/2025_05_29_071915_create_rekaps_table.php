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
        Schema::create('rekaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->string('nama_pasien', 50);
            $table->string('nik', 16);
            $table->string('jenis_kelamin', 25);
            $table->text('alamat');
            $table->unsignedTinyInteger('umur');
            $table->decimal('tinggi_badan', 5, 2);
            $table->date('tanggal_reservasi');
            $table->string('no_telepon', 15);
            $table->decimal('berat_badan', 5, 2);
            $table->text('diagnosa_penyakit');
            $table->text('saran_pengobatan');
            $table->string('no_bpjs', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekaps');
    }
};
