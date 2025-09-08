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
        Schema::create('pariwisata_budayas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->string('nama_objek');
            $table->enum('jenis', ['pariwisata_alam', 'pariwisata_budaya', 'pariwisata_religi', 'budaya_adat', 'seni_tradisional']);
            $table->text('deskripsi')->nullable();
            $table->text('lokasi')->nullable();
            $table->integer('pengunjung_tahunan')->nullable();
            $table->decimal('potensi_pendapatan', 15, 2)->nullable()->comment('Estimasi pendapatan tahunan');
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif', 'dalam_pengembangan'])->default('aktif');
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['desa_id', 'jenis']);
            $table->index('nama_objek');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pariwisata_budayas');
    }
};