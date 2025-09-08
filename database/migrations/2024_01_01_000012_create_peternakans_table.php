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
        Schema::create('peternakans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->enum('jenis_ternak', ['sapi', 'kerbau', 'kambing', 'domba', 'ayam_kampung', 'ayam_broiler', 'bebek', 'itik', 'ikan']);
            $table->integer('populasi')->default(0);
            $table->string('pemilik')->nullable();
            $table->text('produk')->nullable()->comment('Susu, daging, telur, dll');
            $table->text('pakan_ternak')->nullable();
            $table->decimal('produksi_tahunan', 12, 2)->nullable()->comment('Produksi dalam kg/liter per tahun');
            $table->year('tahun_data');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['desa_id', 'jenis_ternak']);
            $table->index(['desa_id', 'tahun_data']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peternakans');
    }
};