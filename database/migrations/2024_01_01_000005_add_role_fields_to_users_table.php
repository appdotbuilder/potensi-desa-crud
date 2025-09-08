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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');
            $table->foreignId('desa_id')->nullable()->constrained('desas')->onDelete('set null');
            $table->foreignId('kecamatan_id')->nullable()->constrained('kecamatans')->onDelete('set null');
            $table->foreignId('kabupaten_id')->nullable()->constrained('kabupatens')->onDelete('set null');
            $table->string('phone', 20)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
            
            $table->index(['role_id', 'status']);
            $table->index('desa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['desa_id']);
            $table->dropForeign(['kecamatan_id']);
            $table->dropForeign(['kabupaten_id']);
            $table->dropColumn(['role_id', 'desa_id', 'kecamatan_id', 'kabupaten_id', 'phone', 'status', 'deleted_at']);
        });
    }
};