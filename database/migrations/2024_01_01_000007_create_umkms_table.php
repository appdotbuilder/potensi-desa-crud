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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->string('nama_usaha');
            $table->enum('jenis_usaha', ['perdagangan', 'jasa', 'manufaktur', 'kuliner', 'kerajinan', 'pertanian']);
            $table->string('pemilik');
            $table->text('alamat')->nullable();
            $table->integer('jumlah_pekerja')->default(0);
            $table->decimal('omset_tahunan', 15, 2)->nullable()->comment('Omset dalam rupiah');
            $table->string('produk_utama')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['desa_id', 'jenis_usaha']);
            $table->index('nama_usaha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};