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
        Schema::create('perkebunan_swastaes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('nama_perkebunan');
            $table->decimal('luas_ha', 10, 2)->default(0);
            $table->string('komoditas');
            $table->enum('pemilik', ['Swasta Nasional', 'Swasta Asing']);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('komoditas');
            $table->index('pemilik');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkebunan_swastaes');
    }
};