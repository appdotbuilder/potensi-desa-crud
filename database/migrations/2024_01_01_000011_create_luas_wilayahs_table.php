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
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->decimal('total_luas', 10, 2)->default(0);
            $table->decimal('tanah_perkebunan_ha', 10, 2)->default(0);
            $table->decimal('tanah_sawah_ha', 10, 2)->default(0);
            $table->decimal('tanah_kering_ha', 10, 2)->default(0);
            $table->decimal('tanah_basah_ha', 10, 2)->default(0);
            $table->decimal('tanah_fasilitas_umum_ha', 10, 2)->default(0);
            $table->decimal('tanah_hutan_ha', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('deleted_at');
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