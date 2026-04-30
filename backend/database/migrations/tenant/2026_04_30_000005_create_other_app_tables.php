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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang', 100);
            $table->date('tgl_beli')->nullable();
            $table->integer('unit')->default(0);
            $table->decimal('harga_satuan', 20, 2)->default(0);
            $table->integer('umur_ekonomis')->default(0);
            $table->string('status', 50)->default('Baik');
            $table->timestamps();
            $table->softDeletes();

            $table->index('nama_barang');
        });

        Schema::create('calk', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->text('catatan');
            $table->timestamps();
        });

        Schema::create('whatsapp_configs', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('token', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tanda_tangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('jabatan', 100);
            $table->text('tanda_tangan')->nullable();
            $table->timestamps();
        });

        Schema::create('arus_kas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_akun', 255);
            $table->integer('urutan')->default(0);
            $table->integer('sub')->default(0);
            $table->char('status', 1)->default('A');
            $table->timestamps();
        });

        Schema::create('arus_kas_rekenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arus_kas_id')->constrained('arus_kas')->cascadeOnDelete();
            $table->string('rekening_debit', 50)->nullable();
            $table->string('rekening_kredit', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('dokumen_pinjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen', 255);
            $table->string('file_path', 255)->nullable();
            $table->boolean('is_custom')->default(false);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('ebudgeting', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun', 50);
            $table->integer('tahun');
            $table->integer('bulan');
            $table->decimal('jumlah', 20, 2)->default(0);
            $table->timestamps();

            $table->index(['kode_akun', 'tahun', 'bulan']);
        });

        Schema::create('usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usaha');
        Schema::dropIfExists('ebudgeting');
        Schema::dropIfExists('dokumen_pinjaman');
        Schema::dropIfExists('arus_kas_rekenings');
        Schema::dropIfExists('arus_kas');
        Schema::dropIfExists('tanda_tangan');
        Schema::dropIfExists('whatsapp_configs');
        Schema::dropIfExists('calk');
        Schema::dropIfExists('inventaris');
    }
};
