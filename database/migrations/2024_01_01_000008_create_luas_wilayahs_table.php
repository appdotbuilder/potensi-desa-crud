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
        Schema::create('luas_wilayahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->decimal('total_luas', 10, 2)->default(0)->comment('Total luas dalam hektar');
            $table->decimal('tanah_perkebunan', 10, 2)->default(0);
            $table->decimal('tanah_sawah', 10, 2)->default(0);
            $table->decimal('tanah_kering', 10, 2)->default(0);
            $table->decimal('tanah_basah', 10, 2)->default(0);
            $table->decimal('tanah_fasilitas_umum', 10, 2)->default(0);
            $table->decimal('tanah_hutan', 10, 2)->default(0);
            $table->decimal('tanah_pemukiman', 10, 2)->default(0);
            $table->year('tahun_data');
            $table->timestamps();
            $table->softDeletes();
            
            $table->unique(['desa_id', 'tahun_data']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luas_wilayahs');
    }
};