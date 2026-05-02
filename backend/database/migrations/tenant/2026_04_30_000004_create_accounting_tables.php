<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akun_level1s', function (Blueprint $table) {
            $table->string('kode_akun', 10)->primary();
            $table->string('nama_akun', 100);
            $table->timestamps();
        });

        Schema::create('akun_level2s', function (Blueprint $table) {
            $table->string('kode_akun', 10)->primary();
            $table->string('nama_akun', 100);
            $table->string('parent_id', 10)->constrained('akun_level1s', 'kode_akun');
            $table->timestamps();
        });

        Schema::create('akun_level3s', function (Blueprint $table) {
            $table->string('kode_akun', 10)->primary();
            $table->string('nama_akun', 100);
            $table->string('parent_id', 10)->constrained('akun_level2s', 'kode_akun');
            $table->timestamps();
        });

        Schema::create('rekenings', function (Blueprint $table) {
            $table->string('kode_akun', 50)->primary();
            $table->string('nama_akun', 255);
            $table->string('parent_id', 10)->nullable();
            $table->integer('lev1')->default(0);
            $table->integer('lev2')->default(0);
            $table->integer('lev3')->default(0);
            $table->integer('lev4')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun', 50);
            $table->integer('tahun');
            for ($i = 1; $i <= 12; $i++) {
                $m = str_pad($i, 2, '0', STR_PAD_LEFT);
                $table->decimal("debit_{$m}", 20, 2)->default(0);
                $table->decimal("kredit_{$m}", 20, 2)->default(0);
            }
            $table->timestamps();
            $table->unique(['kode_akun', 'tahun']);
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('idt');
            $table->date('tgl_transaksi');
            $table->string('rekening_debit', 50);
            $table->string('rekening_kredit', 50);
            $table->string('idtp', 20)->nullable();
            $table->integer('id_pinj')->default(0);
            $table->text('keterangan_transaksi');
            $table->decimal('jumlah', 20, 2);
            $table->integer('id_user')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('tgl_transaksi');
            $table->index('rekening_debit');
            $table->index('rekening_kredit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('balances');
        Schema::dropIfExists('rekenings');
        Schema::dropIfExists('akun_level3s');
        Schema::dropIfExists('akun_level2s');
        Schema::dropIfExists('akun_level1s');
    }
};
