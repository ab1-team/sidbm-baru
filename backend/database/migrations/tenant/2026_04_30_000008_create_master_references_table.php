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
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id();
            $table->string('tingkat', 50);
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

        Schema::create('jenis_usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ju', 100);
            $table->string('deskripsi')->nullable();
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga');
        Schema::dropIfExists('fungsi_kelompok');
        Schema::dropIfExists('tingkat_kelompok');
        Schema::dropIfExists('jenis_kegiatan');
        Schema::dropIfExists('jenis_usaha');
        Schema::dropIfExists('jabatan');
        Schema::dropIfExists('pendidikan');
    }
};
