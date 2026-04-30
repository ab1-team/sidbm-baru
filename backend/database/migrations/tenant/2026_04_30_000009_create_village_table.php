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
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->string('kd_desa', 16)->unique();
            $table->string('nama_desa', 100);
            $table->string('alamat_desa')->nullable();
            $table->string('telp_desa', 20)->nullable();
            $table->string('kades', 100)->nullable();
            $table->string('sekdes', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa');
    }
};
