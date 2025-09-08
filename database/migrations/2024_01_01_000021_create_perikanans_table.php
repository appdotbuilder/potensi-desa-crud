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
        Schema::create('perikanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis_ikan');
            $table->decimal('produksi_ton', 10, 2)->default(0);
            $table->enum('metode', ['Tangkap', 'Budidaya']);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('jenis_ikan');
            $table->index('metode');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perikanans');
    }
};