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
        Schema::create('kelautans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->decimal('luas_perairan_ha', 10, 2)->default(0);
            $table->enum('jenis_aktivitas', ['Penangkapan Ikan', 'Budidaya', 'Transportasi']);
            $table->decimal('produksi_ton', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('jenis_aktivitas');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelautans');
    }
};