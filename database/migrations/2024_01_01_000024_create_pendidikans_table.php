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
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->enum('jenis_sekolah', ['SD', 'SMP', 'SMA', 'SMK', 'Perguruan Tinggi']);
            $table->integer('jumlah')->default(0);
            $table->integer('jumlah_siswa')->default(0);
            $table->integer('jumlah_guru')->default(0);
            $table->text('fasilitas')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('jenis_sekolah');
            $table->index('deleted_at');
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