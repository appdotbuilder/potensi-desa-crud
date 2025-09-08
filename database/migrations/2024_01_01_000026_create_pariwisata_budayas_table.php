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
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('nama_objek');
            $table->enum('jenis', ['Pariwisata Alam', 'Pariwisata Budaya', 'Adat', 'Seni Tradisional']);
            $table->text('deskripsi')->nullable();
            $table->text('lokasi')->nullable();
            $table->integer('pengunjung_tahunan')->default(0);
            $table->decimal('potensi_pendapatan', 15, 2)->default(0);
            $table->string('gambar')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('jenis');
            $table->index('deleted_at');
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