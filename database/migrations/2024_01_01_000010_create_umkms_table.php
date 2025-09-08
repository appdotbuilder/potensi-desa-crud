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
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('nama_usaha');
            $table->enum('jenis_usaha', ['Perdagangan', 'Jasa', 'Manufaktur', 'Kuliner']);
            $table->integer('jumlah_pekerja')->default(0);
            $table->decimal('omset_tahunan', 15, 2)->default(0);
            $table->text('alamat')->nullable();
            $table->string('pemilik');
            $table->string('kontak')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('jenis_usaha');
            $table->index('deleted_at');
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