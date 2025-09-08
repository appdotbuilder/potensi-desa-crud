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
        Schema::create('jaringan_jalan_sungais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->decimal('panjang_jalan_km', 8, 2)->default(0);
            $table->enum('kondisi_jalan', ['Aspal Baik', 'Aspal Rusak', 'Tanah', 'Kerikil']);
            $table->decimal('panjang_sungai_km', 8, 2)->default(0);
            $table->text('aksesibilitas')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('kondisi_jalan');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jaringan_jalan_sungais');
    }
};