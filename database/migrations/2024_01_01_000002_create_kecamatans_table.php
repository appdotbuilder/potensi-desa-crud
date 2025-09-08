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
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kabupaten_id')->constrained('kabupatens')->onDelete('cascade');
            $table->string('nama_kecamatan');
            $table->text('alamat')->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('telepon', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('nama_kecamatan');
            $table->index(['kabupaten_id', 'nama_kecamatan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatans');
    }
};