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
            $table->text('alamat')->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('telepon', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('nama_kabupaten');
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