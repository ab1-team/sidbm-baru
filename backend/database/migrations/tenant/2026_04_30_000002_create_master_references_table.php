<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('tingkat', 50);
            $table->string('deskropolis')->nullable(); // Legacy support if needed
            $table->string('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan', 100);
            $table->text('tupoksi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('level', function (Blueprint $table) {
            $table->id();
            $table->string('nama_level', 50);
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('jenis_jasa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jasa', 100);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('jenis_produk_pinjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jpp', 100);
            $table->text('deskripsi')->nullable();
            $table->string('warna', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('status_pinjaman', function (Blueprint $table) {
            $table->id();
            $table->char('kd_status', 1)->unique();
            $table->string('nama_status', 50);
            $table->string('warna', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('jenis_usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ju', 100);
            $table->string('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('unit_usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('jenis_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jk', 100);
            $table->string('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tingkat_kelompok', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tk', 100);
            $table->string('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('fungsi_kelompok', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fgs', 100);
            $table->string('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('kekeluargaan', 100);
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('sistem_angsuran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sistem', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sistem_angsuran');
        Schema::dropIfExists('keluarga');
        Schema::dropIfExists('fungsi_kelompok');
        Schema::dropIfExists('tingkat_kelompok');
        Schema::dropIfExists('jenis_kegiatan');
        Schema::dropIfExists('unit_usaha');
        Schema::dropIfExists('jenis_usaha');
        Schema::dropIfExists('status_pinjaman');
        Schema::dropIfExists('jenis_produk_pinjaman');
        Schema::dropIfExists('jenis_jasa');
        Schema::dropIfExists('level');
        Schema::dropIfExists('jabatan');
        Schema::dropIfExists('pendidikan');
    }
};
