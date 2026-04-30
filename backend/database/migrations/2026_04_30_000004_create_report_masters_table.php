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
        Schema::create('jenis_laporan', function (Blueprint $table) {
            $table->id();
            $table->integer('urut')->default(0);
            $table->string('nama_laporan', 50)->default('0');
            $table->string('file', 20)->default('0');
            $table->integer('status')->default(0);
            $table->integer('kab')->nullable();
            $table->integer('prov')->nullable();
            $table->integer('mobile')->default(0);
            $table->timestamps();
        });

        Schema::create('sub_laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_laporan', 50)->default('0');
            $table->string('file', 5)->default('0');
            $table->string('file_kab', 5)->default('0');
            $table->integer('urut')->default(0);
            $table->foreignId('id_lap')->constrained('jenis_laporan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_laporan');
        Schema::dropIfExists('jenis_laporan');
    }
};
