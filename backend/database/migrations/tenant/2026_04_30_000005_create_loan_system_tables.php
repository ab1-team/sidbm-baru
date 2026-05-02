<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjaman_kelompok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_id')->constrained('kelompok');
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
            $table->integer('jangka')->default(12);
            $table->integer('sistem_angsuran')->default(1);
            $table->string('spk_no', 100)->nullable();
            $table->char('status', 1)->default('P');
            $table->text('catatan_verifikasi')->nullable();
            $table->text('catatan_bimbingan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pinjaman_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggota');
            $table->foreignId('pinjaman_kelompok_id')->constrained('pinjaman_kelompok')->onDelete('cascade');
            $table->foreignId('jpp_id')->constrained('jenis_produk_pinjaman');
            $table->string('nia', 50)->nullable();
            $table->date('tgl_proposal')->nullable();
            $table->date('tgl_verifikasi')->nullable();
            $table->date('tgl_dana')->nullable();
            $table->date('tgl_cair')->nullable();
            $table->date('tgl_lunas')->nullable();
            $table->decimal('proposal', 20, 2)->default(0);
            $table->decimal('verifikasi', 20, 2)->default(0);
            $table->decimal('alokasi', 20, 2)->default(0);
            $table->decimal('pros_jasa', 5, 2)->default(0);
            $table->integer('jangka')->default(12);
            $table->integer('sistem_angsuran')->default(1);
            $table->char('status', 1)->default('P');
            $table->text('catatan_verifikasi')->nullable();
            $table->text('catatan_bimbingan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('rencana_angsuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_kelompok_id')->constrained('pinjaman_kelompok')->onDelete('cascade');
            $table->integer('angsuran_ke');
            $table->date('jatuh_tempo');
            $table->decimal('wajib_pokok', 20, 2)->default(0);
            $table->decimal('wajib_jasa', 20, 2)->default(0);
            $table->decimal('target_pokok', 20, 2)->default(0);
            $table->decimal('target_jasa', 20, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('real_angsuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_kelompok_id')->constrained('pinjaman_kelompok')->onDelete('cascade');
            $table->date('tgl_transaksi');
            $table->decimal('realisasi_pokok', 20, 2)->default(0);
            $table->decimal('realisasi_jasa', 20, 2)->default(0);
            $table->decimal('saldo_pokok', 20, 2)->default(0);
            $table->decimal('saldo_jasa', 20, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('real_angsuran');
        Schema::dropIfExists('rencana_angsuran');
        Schema::dropIfExists('pinjaman_anggota');
        Schema::dropIfExists('pinjaman_kelompok');
    }
};
