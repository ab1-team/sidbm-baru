<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->string('kd_desa', 20)->unique();
            $table->string('nama_desa', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('kelompok', function (Blueprint $table) {
            $table->id();
            $table->string('kd_kelompok', 50)->unique();
            $table->string('nama_kelompok', 200);
            $table->string('alamat_kelompok')->nullable();
            $table->string('telpon', 20)->nullable();
            $table->date('tgl_berdiri')->nullable();
            $table->string('ketua', 100)->nullable();
            $table->string('sekretaris', 100)->nullable();
            $table->string('bendahara', 100)->nullable();
            $table->foreignId('desa_id')->nullable()->constrained('desa');
            $table->foreignId('jpp_id')->nullable()->constrained('jenis_produk_pinjaman');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->index('nama_kelompok');
        });

        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20); // Removed unique() to support legacy data migration
            $table->string('nama_lengkap', 200);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('hp', 20)->nullable();
            $table->string('kk', 20)->nullable();
            $table->string('nik_penjamin', 20)->nullable();
            $table->string('nama_penjamin', 100)->nullable();
            $table->string('hubungan_penjamin', 50)->nullable();
            $table->string('usaha', 100)->nullable();
            $table->string('foto')->nullable();
            $table->date('tgl_gabung')->nullable();
            $table->foreignId('desa_id')->nullable()->constrained('desa');
            $table->foreignId('kelompok_id')->nullable()->constrained('kelompok');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->index('nama_lengkap');
            $table->index('nik');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
        Schema::dropIfExists('kelompok');
        Schema::dropIfExists('desa');
    }
};
