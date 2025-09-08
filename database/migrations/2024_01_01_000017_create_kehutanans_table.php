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
        Schema::create('kehutanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->enum('kepemilikan', ['Negara', 'Swasta', 'Masyarakat']);
            $table->text('hasil_hutan')->nullable();
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat']);
            $table->decimal('luas_hutan_ha', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('kepemilikan');
            $table->index('kondisi');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehutanans');
    }
};