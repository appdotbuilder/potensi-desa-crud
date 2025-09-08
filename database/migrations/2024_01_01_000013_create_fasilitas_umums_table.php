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
        Schema::create('fasilitas_umums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->enum('jenis_fasilitas', [
                'balai_desa', 'masjid', 'gereja', 'pura', 'vihara', 'pos_ronda',
                'pasar', 'terminal', 'jembatan', 'makam', 'lapangan_olahraga'
            ]);
            $table->string('nama_fasilitas');
            $table->integer('jumlah')->default(1);
            $table->enum('kondisi', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik');
            $table->text('lokasi')->nullable();
            $table->year('tahun_dibangun')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('fasilitas_umums');
    }
};