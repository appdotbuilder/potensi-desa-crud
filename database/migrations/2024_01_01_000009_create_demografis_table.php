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
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->integer('total_penduduk')->default(0);
            $table->integer('laki_laki')->default(0);
            $table->integer('perempuan')->default(0);
            $table->integer('usia_0_2')->default(0);
            $table->integer('usia_0_5')->default(0);
            $table->integer('usia_17_plus')->default(0);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('pendidikan_terakhir', ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Pascasarjana']);
            $table->enum('pekerjaan', ['Petani', 'Pedagang', 'PNS', 'Swasta', 'Nelayan', 'Buruh', 'Lainnya']);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('deleted_at');
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