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
        Schema::create('tanaman_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->string('nama_tanaman');
            $table->decimal('luas_tanam', 10, 2)->default(0)->comment('Luas tanam dalam hektar');
            $table->decimal('produksi', 12, 2)->default(0)->comment('Produksi dalam ton');
            $table->string('bagian_digunakan')->nullable()->comment('Daun, akar, buah, dll');
            $table->text('kegunaan')->nullable();
            $table->year('tahun_data');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['desa_id', 'tahun_data']);
            $table->index('nama_tanaman');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanaman_obats');
    }
};