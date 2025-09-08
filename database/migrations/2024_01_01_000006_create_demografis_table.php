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
        Schema::create('demografis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->integer('total_penduduk')->default(0);
            $table->integer('laki_laki')->default(0);
            $table->integer('perempuan')->default(0);
            $table->integer('usia_0_14')->default(0);
            $table->integer('usia_15_64')->default(0);
            $table->integer('usia_65_plus')->default(0);
            $table->enum('agama_mayoritas', ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu'])->nullable();
            $table->integer('islam')->default(0);
            $table->integer('kristen')->default(0);
            $table->integer('katolik')->default(0);
            $table->integer('hindu')->default(0);
            $table->integer('buddha')->default(0);
            $table->integer('konghucu')->default(0);
            $table->integer('tidak_sekolah')->default(0);
            $table->integer('sd')->default(0);
            $table->integer('smp')->default(0);
            $table->integer('sma')->default(0);
            $table->integer('diploma')->default(0);
            $table->integer('sarjana')->default(0);
            $table->integer('petani')->default(0);
            $table->integer('pedagang')->default(0);
            $table->integer('pns')->default(0);
            $table->integer('swasta')->default(0);
            $table->integer('tidak_bekerja')->default(0);
            $table->year('tahun_data');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['desa_id', 'tahun_data']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demografis');
    }
};