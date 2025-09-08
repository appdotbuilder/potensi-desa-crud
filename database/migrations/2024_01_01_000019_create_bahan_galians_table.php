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
        Schema::create('bahan_galians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained()->onDelete('cascade');
            $table->string('jenis_mineral');
            $table->decimal('cadangan_ton', 12, 2)->default(0);
            $table->text('lokasi')->nullable();
            $table->enum('status_eksploitasi', ['Belum Dieksploitasi', 'Sedang Dieksploitasi', 'Sudah Dieksploitasi']);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('desa_id');
            $table->index('jenis_mineral');
            $table->index('status_eksploitasi');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_galians');
    }
};