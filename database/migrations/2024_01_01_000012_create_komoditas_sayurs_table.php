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
        Schema::create('komoditas_sayurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('nama_komoditas');
            $table->decimal('luas_tanam_ha', 10, 2)->default(0);
            $table->decimal('produksi_ton', 10, 2)->default(0);
            $table->decimal('harga_rupiah', 12, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('nama_komoditas');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komoditas_sayurs');
    }
};