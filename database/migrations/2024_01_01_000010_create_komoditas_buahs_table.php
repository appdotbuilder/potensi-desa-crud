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
        Schema::create('komoditas_buahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->string('nama_komoditas');
            $table->decimal('luas_tanam', 10, 2)->default(0)->comment('Luas tanam dalam hektar');
            $table->decimal('produksi', 12, 2)->default(0)->comment('Produksi dalam ton');
            $table->decimal('harga_per_kg', 10, 2)->nullable()->comment('Harga per kg dalam rupiah');
            $table->enum('musim_panen', ['januari-maret', 'april-juni', 'juli-september', 'oktober-desember', 'sepanjang_tahun'])->default('sepanjang_tahun');
            $table->year('tahun_data');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['desa_id', 'tahun_data']);
            $table->index('nama_komoditas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komoditas_buahs');
    }
};