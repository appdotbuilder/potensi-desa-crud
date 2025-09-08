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
            $table->foreignId('kabupaten_id')->constrained('kabupatens')->onDelete('cascade');
            $table->foreignId('kecamatan_id')->constrained('kecamatans')->onDelete('cascade');
            $table->string('nama_desa');
            $table->text('alamat')->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('nama_kepala_desa')->nullable();
            $table->decimal('luas_wilayah', 10, 2)->nullable()->comment('Luas wilayah dalam hektar');
            $table->integer('jumlah_penduduk')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('nama_desa');
            $table->index(['kecamatan_id', 'nama_desa']);
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