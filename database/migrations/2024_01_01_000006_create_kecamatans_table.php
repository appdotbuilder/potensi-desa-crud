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
            $table->string('nama_kecamatan');
            $table->foreignId('kabupaten_id')->constrained()->onDelete('cascade');
            $table->string('ibukota_kecamatan');
            $table->integer('jumlah_desa')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('nama_kecamatan');
            $table->index('kabupaten_id');
            $table->index('deleted_at');
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