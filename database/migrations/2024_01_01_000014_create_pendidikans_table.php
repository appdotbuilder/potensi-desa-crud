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
        Schema::create('pendidikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->enum('jenis_sekolah', ['paud', 'tk', 'sd', 'smp', 'sma', 'smk', 'pesantren']);
            $table->string('nama_sekolah');
            $table->integer('jumlah_siswa')->default(0);
            $table->integer('jumlah_guru')->default(0);
            $table->integer('jumlah_ruang_kelas')->default(0);
            $table->enum('kondisi_bangunan', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik');
            $table->text('fasilitas')->nullable()->comment('Perpustakaan, lab, dll');
            $table->text('alamat')->nullable();
            $table->year('tahun_berdiri')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['desa_id', 'jenis_sekolah']);
            $table->index('nama_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikans');
    }
};