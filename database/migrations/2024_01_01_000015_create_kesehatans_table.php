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
        Schema::create('kesehatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->enum('jenis_fasilitas', ['puskesmas', 'pustu', 'posyandu', 'polindes', 'bidan_desa', 'dokter_praktek']);
            $table->string('nama_fasilitas');
            $table->integer('jumlah_tenaga_medis')->default(0);
            $table->text('peralatan')->nullable();
            $table->enum('kondisi', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik');
            $table->text('alamat')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['desa_id', 'jenis_fasilitas']);
            $table->index('kondisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesehatans');
    }
};