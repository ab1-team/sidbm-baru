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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->char('nik', 16)->index();
            $table->string('nama_lengkap', 100);
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('desa', 17)->nullable();
            $table->string('hp', 20)->nullable();
            $table->string('kk', 20)->nullable();
            $table->string('nik_penjamin', 16)->nullable();
            $table->string('nama_penjamin', 100)->nullable();
            $table->string('hubungan_penjamin', 50)->nullable();
            $table->string('usaha', 100)->nullable();
            $table->text('foto')->nullable();
            $table->date('tgl_gabung')->nullable();
            $table->tinyInteger('status')->default(1); // 1: Aktif, 0: Nonaktif
            $table->timestamps();
            $table->softDeletes();

            $table->index('desa');
        });

        Schema::create('kelompok', function (Blueprint $table) {
            $table->id();
            $table->string('kd_kelompok', 50)->index();
            $table->string('nama_kelompok', 100);
            $table->foreignId('jpp_id')->default(1); // Default to SPP or UEP
            $table->string('desa', 17)->nullable();
            $table->text('alamat_kelompok')->nullable();
            $table->string('telpon', 20)->nullable();
            $table->date('tgl_berdiri')->nullable();
            $table->string('ketua', 100)->nullable();
            $table->string('sekretaris', 100)->nullable();
            $table->string('bendahara', 100)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->index('desa');
        });

        Schema::create('pinjaman_kelompok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_id')->constrained('kelompok')->cascadeOnDelete();
            $table->integer('pinjaman_ke')->default(1);
            $table->foreignId('jpp_id')->constrained('jenis_produk_pinjaman');
            $table->date('tgl_proposal')->nullable();
            $table->date('tgl_verifikasi')->nullable();
            $table->date('tgl_dana')->nullable();
            $table->date('tgl_cair')->nullable();
            $table->date('tgl_lunas')->nullable();
            $table->decimal('proposal', 20, 2)->default(0);
            $table->decimal('verifikasi', 20, 2)->default(0);
            $table->decimal('alokasi', 20, 2)->default(0);
            $table->decimal('pros_jasa', 5, 2)->default(0);
            $table->integer('jangka')->default(0);
            $table->integer('sistem_angsuran')->default(0);
            $table->string('spk_no', 100)->nullable();
            $table->char('status', 1)->default('P'); 
            $table->text('catatan_verifikasi')->nullable();
            $table->text('catatan_bimbingan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('tgl_cair');
        });

        Schema::create('pinjaman_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggota')->cascadeOnDelete();
            $table->foreignId('pinjaman_kelompok_id')->nullable()->constrained('pinjaman_kelompok')->nullOnDelete();
            $table->foreignId('jpp_id')->constrained('jenis_produk_pinjaman');
            $table->string('nia', 30)->nullable(); 
            $table->date('tgl_proposal')->nullable();
            $table->date('tgl_verifikasi')->nullable();
            $table->date('tgl_dana')->nullable();
            $table->date('tgl_cair')->nullable();
            $table->date('tgl_lunas')->nullable();
            $table->decimal('proposal', 20, 2)->default(0);
            $table->decimal('verifikasi', 20, 2)->default(0);
            $table->decimal('alokasi', 20, 2)->default(0);
            $table->decimal('pros_jasa', 5, 2)->default(0);
            $table->integer('jangka')->default(0);
            $table->integer('sistem_angsuran')->default(0);
            $table->char('status', 1)->default('P');
            $table->text('catatan_verifikasi')->nullable();
            $table->text('catatan_bimbingan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('nia');
            $table->index('status');
            $table->index('tgl_cair');
        });

        Schema::create('real_angsuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_kelompok_id')->nullable()->constrained('pinjaman_kelompok')->cascadeOnDelete();
            $table->foreignId('pinjaman_anggota_id')->nullable()->constrained('pinjaman_anggota')->cascadeOnDelete();
            $table->date('tgl_transaksi')->nullable();
            $table->decimal('realisasi_pokok', 20, 2)->default(0);
            $table->decimal('realisasi_jasa', 20, 2)->default(0);
            $table->decimal('saldo_pokok', 20, 2)->default(0);
            $table->decimal('saldo_jasa', 20, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('tgl_transaksi');
        });

        Schema::create('rencana_angsuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_kelompok_id')->nullable()->constrained('pinjaman_kelompok')->cascadeOnDelete();
            $table->foreignId('pinjaman_anggota_id')->nullable()->constrained('pinjaman_anggota')->cascadeOnDelete();
            $table->integer('angsuran_ke')->default(1);
            $table->date('jatuh_tempo')->nullable();
            $table->decimal('wajib_pokok', 20, 2)->default(0);
            $table->decimal('wajib_jasa', 20, 2)->default(0);
            $table->decimal('target_pokok', 20, 2)->default(0);
            $table->decimal('target_jasa', 20, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('jatuh_tempo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_angsuran');
        Schema::dropIfExists('real_angsuran');
        Schema::dropIfExists('pinjaman_kelompok');
        Schema::dropIfExists('pinjaman_anggota');
        Schema::dropIfExists('kelompok');
        Schema::dropIfExists('anggota');
    }
};
