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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan', 100);
            $table->text('tupoksi')->nullable();
            $table->timestamps();
        });

        Schema::create('level', function (Blueprint $table) {
            $table->id();
            $table->string('nama_level', 50);
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pendidikan', 50);
            $table->timestamps();
        });

        Schema::create('jenis_jasa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jasa', 100);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('jenis_produk_pinjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jpp', 100);
            $table->text('deskripsi')->nullable();
            $table->string('warna', 20)->nullable();
            $table->timestamps();

            $table->index('nama_jpp');
        });

        Schema::create('status_pinjaman', function (Blueprint $table) {
            $table->id();
            $table->char('kd_status', 1)->unique();
            $table->string('nama_status', 50);
            $table->string('warna', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('jenis_usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha', 100);
            $table->timestamps();
        });

        Schema::create('unit_usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_usaha');
        Schema::dropIfExists('jenis_usaha');
        Schema::dropIfExists('status_pinjaman');
        Schema::dropIfExists('jenis_produk_pinjaman');
        Schema::dropIfExists('jenis_jasa');
        Schema::dropIfExists('pendidikan');
        Schema::dropIfExists('level');
        Schema::dropIfExists('jabatan');
    }
};
