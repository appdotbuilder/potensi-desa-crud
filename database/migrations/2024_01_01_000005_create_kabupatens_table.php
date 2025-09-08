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
        Schema::create('kabupatens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kabupaten');
            $table->string('ibukota_kabupaten');
            $table->integer('jumlah_kecamatan')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('nama_kabupaten');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabupatens');
    }
};