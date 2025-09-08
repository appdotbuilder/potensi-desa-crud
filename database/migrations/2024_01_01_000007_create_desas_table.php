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
        Schema::create('desas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->foreignId('kecamatan_id')->constrained()->onDelete('cascade');
            $table->foreignId('kabupaten_id')->constrained()->onDelete('cascade');
            $table->text('alamat')->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('kepala_desa');
            $table->decimal('luas_wilayah_total', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('nama_desa');
            $table->index('kecamatan_id');
            $table->index('kabupaten_id');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};