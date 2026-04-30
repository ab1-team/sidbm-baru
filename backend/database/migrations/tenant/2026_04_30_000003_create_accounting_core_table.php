<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekenings', function (Blueprint $table) {
            $table->string('kode_akun', 10)->primary();
            $table->string('parent_id', 50)->nullable();
            $table->integer('lev1')->default(0);
            $table->integer('lev2')->default(0);
            $table->integer('lev3')->default(0);
            $table->integer('lev4')->default(0);
            $table->string('nama_akun', 100)->default('0');
            $table->string('jenis_mutasi', 6)->default('0');
            $table->date('tgl_nonaktif')->nullable();
            $table->string('saldo_awal', 100)->default('0');
            // Historical columns
            for ($year = 2015; $year <= 2022; $year++) {
                $table->string("tb{$year}", 100)->default('0');
                $table->string("tbk{$year}", 100)->default('0');
            }
            $table->timestamps();

            $table->index('parent_id');
            $table->index(['lev1', 'lev2', 'lev3', 'lev4'], 'idx_levels');
        });

        Schema::create('balances', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('kode_akun');
            $table->string('tahun');

            for ($i = 1; $i <= 12; $i++) {
                $month = str_pad($i, 2, '0', STR_PAD_LEFT);
                $table->decimal("debit_{$month}", 20, 2)->default(0);
                $table->decimal("kredit_{$month}", 20, 2)->default(0);
            }

            $table->timestamps();

            $table->index(['kode_akun', 'tahun'], 'idx_rekening_tahun');
        });

        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('idt');
            $table->date('tgl_transaksi')->nullable();
            $table->string('rekening_debit', 10)->default('0');
            $table->string('rekening_kredit', 10)->default('0');
            $table->integer('idtp')->default(0);
            $table->integer('id_pinj')->default(0);
            $table->integer('id_pinj_i')->default(0);
            $table->text('keterangan_transaksi')->nullable();
            $table->text('relasi')->nullable();
            $table->decimal('jumlah', 20, 2)->default(0);
            $table->integer('urutan')->default(0);
            $table->integer('id_user')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->index('tgl_transaksi');
            $table->index('rekening_debit');
            $table->index('rekening_kredit');
            $table->index('id_pinj');
            $table->index(['idtp', 'id_pinj'], 'idx_pinjaman');
        });

        // TRIGGERS
        DB::unprepared("
            CREATE TRIGGER after_transaksi_insert
            AFTER INSERT ON transaksi
            FOR EACH ROW
            BEGIN
                DECLARE bulan INT;
                DECLARE tahun_trx VARCHAR(4);
                DECLARE id_debit BIGINT;
                DECLARE id_kredit BIGINT;
                DECLARE kode_debit_clean VARCHAR(50);
                DECLARE kode_kredit_clean VARCHAR(50);
                
                SET bulan = MONTH(NEW.tgl_transaksi);
                SET tahun_trx = YEAR(NEW.tgl_transaksi);
                
                SET kode_debit_clean = REPLACE(NEW.rekening_debit, '.', '');
                SET kode_kredit_clean = REPLACE(NEW.rekening_kredit, '.', '');
                
                SET id_debit = CAST(CONCAT(kode_debit_clean, tahun_trx) AS UNSIGNED);
                SET id_kredit = CAST(CONCAT(kode_kredit_clean, tahun_trx) AS UNSIGNED);
                
                INSERT INTO balances (
                    id, kode_akun, tahun,
                    debit_01, kredit_01, debit_02, kredit_02, debit_03, kredit_03,
                    debit_04, kredit_04, debit_05, kredit_05, debit_06, kredit_06,
                    debit_07, kredit_07, debit_08, kredit_08, debit_09, kredit_09,
                    debit_10, kredit_10, debit_11, kredit_11, debit_12, kredit_12,
                    created_at, updated_at
                ) VALUES (
                    id_debit, NEW.rekening_debit, tahun_trx,
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                    NOW(), NOW()
                )
                ON DUPLICATE KEY UPDATE
                    debit_01 = CASE WHEN bulan = 1 THEN debit_01 + NEW.jumlah ELSE debit_01 END,
                    debit_02 = CASE WHEN bulan = 2 THEN debit_02 + NEW.jumlah ELSE debit_02 END,
                    debit_03 = CASE WHEN bulan = 3 THEN debit_03 + NEW.jumlah ELSE debit_03 END,
                    debit_04 = CASE WHEN bulan = 4 THEN debit_04 + NEW.jumlah ELSE debit_04 END,
                    debit_05 = CASE WHEN bulan = 5 THEN debit_05 + NEW.jumlah ELSE debit_05 END,
                    debit_06 = CASE WHEN bulan = 6 THEN debit_06 + NEW.jumlah ELSE debit_06 END,
                    debit_07 = CASE WHEN bulan = 7 THEN debit_07 + NEW.jumlah ELSE debit_07 END,
                    debit_08 = CASE WHEN bulan = 8 THEN debit_08 + NEW.jumlah ELSE debit_08 END,
                    debit_09 = CASE WHEN bulan = 9 THEN debit_09 + NEW.jumlah ELSE debit_09 END,
                    debit_10 = CASE WHEN bulan = 10 THEN debit_10 + NEW.jumlah ELSE debit_10 END,
                    debit_11 = CASE WHEN bulan = 11 THEN debit_11 + NEW.jumlah ELSE debit_11 END,
                    debit_12 = CASE WHEN bulan = 12 THEN debit_12 + NEW.jumlah ELSE debit_12 END,
                    updated_at = NOW();

                INSERT INTO balances (
                    id, kode_akun, tahun,
                    debit_01, kredit_01, debit_02, kredit_02, debit_03, kredit_03,
                    debit_04, kredit_04, debit_05, kredit_05, debit_06, kredit_06,
                    debit_07, kredit_07, debit_08, kredit_08, debit_09, kredit_09,
                    debit_10, kredit_10, debit_11, kredit_11, debit_12, kredit_12,
                    created_at, updated_at
                ) VALUES (
                    id_kredit, NEW.rekening_kredit, tahun_trx,
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                    NOW(), NOW()
                )
                ON DUPLICATE KEY UPDATE
                    kredit_01 = CASE WHEN bulan = 1 THEN kredit_01 + NEW.jumlah ELSE kredit_01 END,
                    kredit_02 = CASE WHEN bulan = 2 THEN kredit_02 + NEW.jumlah ELSE kredit_02 END,
                    kredit_03 = CASE WHEN bulan = 3 THEN kredit_03 + NEW.jumlah ELSE kredit_03 END,
                    kredit_04 = CASE WHEN bulan = 4 THEN kredit_04 + NEW.jumlah ELSE kredit_04 END,
                    kredit_05 = CASE WHEN bulan = 5 THEN kredit_05 + NEW.jumlah ELSE kredit_05 END,
                    kredit_06 = CASE WHEN bulan = 6 THEN kredit_06 + NEW.jumlah ELSE kredit_06 END,
                    kredit_07 = CASE WHEN bulan = 7 THEN kredit_07 + NEW.jumlah ELSE kredit_07 END,
                    kredit_08 = CASE WHEN bulan = 8 THEN kredit_08 + NEW.jumlah ELSE kredit_08 END,
                    kredit_09 = CASE WHEN bulan = 9 THEN kredit_09 + NEW.jumlah ELSE kredit_09 END,
                    kredit_10 = CASE WHEN bulan = 10 THEN kredit_10 + NEW.jumlah ELSE kredit_10 END,
                    kredit_11 = CASE WHEN bulan = 11 THEN kredit_11 + NEW.jumlah ELSE kredit_11 END,
                    kredit_12 = CASE WHEN bulan = 12 THEN kredit_12 + NEW.jumlah ELSE kredit_12 END,
                    updated_at = NOW();
            END
        ");

        DB::unprepared("
            CREATE TRIGGER after_transaksi_update
            AFTER UPDATE ON transaksi
            FOR EACH ROW
            BEGIN
                DECLARE bulan_old INT;
                DECLARE tahun_old VARCHAR(4);
                DECLARE bulan_new INT;
                DECLARE tahun_new VARCHAR(4);
                DECLARE id_debit_old BIGINT;
                DECLARE id_kredit_old BIGINT;
                DECLARE id_debit_new BIGINT;
                DECLARE id_kredit_new BIGINT;
                
                SET bulan_old = MONTH(OLD.tgl_transaksi);
                SET tahun_old = YEAR(OLD.tgl_transaksi);
                SET bulan_new = MONTH(NEW.tgl_transaksi);
                SET tahun_new = YEAR(NEW.tgl_transaksi);
                
                SET id_debit_old = CAST(CONCAT(REPLACE(OLD.rekening_debit, '.', ''), tahun_old) AS UNSIGNED);
                SET id_kredit_old = CAST(CONCAT(REPLACE(OLD.rekening_kredit, '.', ''), tahun_old) AS UNSIGNED);
                SET id_debit_new = CAST(CONCAT(REPLACE(NEW.rekening_debit, '.', ''), tahun_new) AS UNSIGNED);
                SET id_kredit_new = CAST(CONCAT(REPLACE(NEW.rekening_kredit, '.', ''), tahun_new) AS UNSIGNED);
                
                -- Reverse old values
                UPDATE balances SET
                    debit_01 = CASE WHEN bulan_old = 1 THEN debit_01 - OLD.jumlah ELSE debit_01 END,
                    debit_02 = CASE WHEN bulan_old = 2 THEN debit_02 - OLD.jumlah ELSE debit_02 END,
                    debit_03 = CASE WHEN bulan_old = 3 THEN debit_03 - OLD.jumlah ELSE debit_03 END,
                    debit_04 = CASE WHEN bulan_old = 4 THEN debit_04 - OLD.jumlah ELSE debit_04 END,
                    debit_05 = CASE WHEN bulan_old = 5 THEN debit_05 - OLD.jumlah ELSE debit_05 END,
                    debit_06 = CASE WHEN bulan_old = 6 THEN debit_06 - OLD.jumlah ELSE debit_06 END,
                    debit_07 = CASE WHEN bulan_old = 7 THEN debit_07 - OLD.jumlah ELSE debit_07 END,
                    debit_08 = CASE WHEN bulan_old = 8 THEN debit_08 - OLD.jumlah ELSE debit_08 END,
                    debit_09 = CASE WHEN bulan_old = 9 THEN debit_09 - OLD.jumlah ELSE debit_09 END,
                    debit_10 = CASE WHEN bulan_old = 10 THEN debit_10 - OLD.jumlah ELSE debit_10 END,
                    debit_11 = CASE WHEN bulan_old = 11 THEN debit_11 - OLD.jumlah ELSE debit_11 END,
                    debit_12 = CASE WHEN bulan_old = 12 THEN debit_12 - OLD.jumlah ELSE debit_12 END,
                    updated_at = NOW()
                WHERE id = id_debit_old;

                UPDATE balances SET
                    kredit_01 = CASE WHEN bulan_old = 1 THEN kredit_01 - OLD.jumlah ELSE kredit_01 END,
                    kredit_02 = CASE WHEN bulan_old = 2 THEN kredit_02 - OLD.jumlah ELSE kredit_02 END,
                    kredit_03 = CASE WHEN bulan_old = 3 THEN kredit_03 - OLD.jumlah ELSE kredit_03 END,
                    kredit_04 = CASE WHEN bulan_old = 4 THEN kredit_04 - OLD.jumlah ELSE kredit_04 END,
                    kredit_05 = CASE WHEN bulan_old = 5 THEN kredit_05 - OLD.jumlah ELSE kredit_05 END,
                    kredit_06 = CASE WHEN bulan_old = 6 THEN kredit_06 - OLD.jumlah ELSE kredit_06 END,
                    kredit_07 = CASE WHEN bulan_old = 7 THEN kredit_07 - OLD.jumlah ELSE kredit_07 END,
                    kredit_08 = CASE WHEN bulan_old = 8 THEN kredit_08 - OLD.jumlah ELSE kredit_08 END,
                    kredit_09 = CASE WHEN bulan_old = 9 THEN kredit_09 - OLD.jumlah ELSE kredit_09 END,
                    kredit_10 = CASE WHEN bulan_old = 10 THEN kredit_10 - OLD.jumlah ELSE kredit_10 END,
                    kredit_11 = CASE WHEN bulan_old = 11 THEN kredit_11 - OLD.jumlah ELSE kredit_11 END,
                    kredit_12 = CASE WHEN bulan_old = 12 THEN kredit_12 - OLD.jumlah ELSE kredit_12 END,
                    updated_at = NOW()
                WHERE id = id_kredit_old;

                -- Apply new values
                INSERT INTO balances (
                    id, kode_akun, tahun,
                    debit_01, kredit_01, debit_02, kredit_02, debit_03, kredit_03,
                    debit_04, kredit_04, debit_05, kredit_05, debit_06, kredit_06,
                    debit_07, kredit_07, debit_08, kredit_08, debit_09, kredit_09,
                    debit_10, kredit_10, debit_11, kredit_11, debit_12, kredit_12,
                    created_at, updated_at
                ) VALUES (
                    id_debit_new, NEW.rekening_debit, tahun_new,
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                    NOW(), NOW()
                )
                ON DUPLICATE KEY UPDATE
                    debit_01 = CASE WHEN bulan_new = 1 THEN debit_01 + NEW.jumlah ELSE debit_01 END,
                    debit_02 = CASE WHEN bulan_new = 2 THEN debit_02 + NEW.jumlah ELSE debit_02 END,
                    debit_03 = CASE WHEN bulan_new = 3 THEN debit_03 + NEW.jumlah ELSE debit_03 END,
                    debit_04 = CASE WHEN bulan_new = 4 THEN debit_04 + NEW.jumlah ELSE debit_04 END,
                    debit_05 = CASE WHEN bulan_new = 5 THEN debit_05 + NEW.jumlah ELSE debit_05 END,
                    debit_06 = CASE WHEN bulan_new = 6 THEN debit_06 + NEW.jumlah ELSE debit_06 END,
                    debit_07 = CASE WHEN bulan_new = 7 THEN debit_07 + NEW.jumlah ELSE debit_07 END,
                    debit_08 = CASE WHEN bulan_new = 8 THEN debit_08 + NEW.jumlah ELSE debit_08 END,
                    debit_09 = CASE WHEN bulan_new = 9 THEN debit_09 + NEW.jumlah ELSE debit_09 END,
                    debit_10 = CASE WHEN bulan_new = 10 THEN debit_10 + NEW.jumlah ELSE debit_10 END,
                    debit_11 = CASE WHEN bulan_new = 11 THEN debit_11 + NEW.jumlah ELSE debit_11 END,
                    debit_12 = CASE WHEN bulan_new = 12 THEN debit_12 + NEW.jumlah ELSE debit_12 END,
                    updated_at = NOW();

                INSERT INTO balances (
                    id, kode_akun, tahun,
                    debit_01, kredit_01, debit_02, kredit_02, debit_03, kredit_03,
                    debit_04, kredit_04, debit_05, kredit_05, debit_06, kredit_06,
                    debit_07, kredit_07, debit_08, kredit_08, debit_09, kredit_09,
                    debit_10, kredit_10, debit_11, kredit_11, debit_12, kredit_12,
                    created_at, updated_at
                ) VALUES (
                    id_kredit_new, NEW.rekening_kredit, tahun_new,
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                    0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                    NOW(), NOW()
                )
                ON DUPLICATE KEY UPDATE
                    kredit_01 = CASE WHEN bulan_new = 1 THEN kredit_01 + NEW.jumlah ELSE kredit_01 END,
                    kredit_02 = CASE WHEN bulan_new = 2 THEN kredit_02 + NEW.jumlah ELSE kredit_02 END,
                    kredit_03 = CASE WHEN bulan_new = 3 THEN kredit_03 + NEW.jumlah ELSE kredit_03 END,
                    kredit_04 = CASE WHEN bulan_new = 4 THEN kredit_04 + NEW.jumlah ELSE kredit_04 END,
                    kredit_05 = CASE WHEN bulan_new = 5 THEN kredit_05 + NEW.jumlah ELSE kredit_05 END,
                    kredit_06 = CASE WHEN bulan_new = 6 THEN kredit_06 + NEW.jumlah ELSE kredit_06 END,
                    kredit_07 = CASE WHEN bulan_new = 7 THEN kredit_07 + NEW.jumlah ELSE kredit_07 END,
                    kredit_08 = CASE WHEN bulan_new = 8 THEN kredit_08 + NEW.jumlah ELSE kredit_08 END,
                    kredit_09 = CASE WHEN bulan_new = 9 THEN kredit_09 + NEW.jumlah ELSE kredit_09 END,
                    kredit_10 = CASE WHEN bulan_new = 10 THEN kredit_10 + NEW.jumlah ELSE kredit_10 END,
                    kredit_11 = CASE WHEN bulan_new = 11 THEN kredit_11 + NEW.jumlah ELSE kredit_11 END,
                    kredit_12 = CASE WHEN bulan_new = 12 THEN kredit_12 + NEW.jumlah ELSE kredit_12 END,
                    updated_at = NOW();
            END
        ");

        DB::unprepared("
            CREATE TRIGGER after_transaksi_delete
            AFTER DELETE ON transaksi
            FOR EACH ROW
            BEGIN
                DECLARE bulan INT;
                DECLARE tahun_trx VARCHAR(4);
                DECLARE id_debit BIGINT;
                DECLARE id_kredit BIGINT;
                
                SET bulan = MONTH(OLD.tgl_transaksi);
                SET tahun_trx = YEAR(OLD.tgl_transaksi);
                
                SET id_debit = CAST(CONCAT(REPLACE(OLD.rekening_debit, '.', ''), tahun_trx) AS UNSIGNED);
                SET id_kredit = CAST(CONCAT(REPLACE(OLD.rekening_kredit, '.', ''), tahun_trx) AS UNSIGNED);
                
                UPDATE balances SET
                    debit_01 = CASE WHEN bulan = 1 THEN debit_01 - OLD.jumlah ELSE debit_01 END,
                    debit_02 = CASE WHEN bulan = 2 THEN debit_02 - OLD.jumlah ELSE debit_02 END,
                    debit_03 = CASE WHEN bulan = 3 THEN debit_03 - OLD.jumlah ELSE debit_03 END,
                    debit_04 = CASE WHEN bulan = 4 THEN debit_04 - OLD.jumlah ELSE debit_04 END,
                    debit_05 = CASE WHEN bulan = 5 THEN debit_05 - OLD.jumlah ELSE debit_05 END,
                    debit_06 = CASE WHEN bulan = 6 THEN debit_06 - OLD.jumlah ELSE debit_06 END,
                    debit_07 = CASE WHEN bulan = 7 THEN debit_07 - OLD.jumlah ELSE debit_07 END,
                    debit_08 = CASE WHEN bulan = 8 THEN debit_08 - OLD.jumlah ELSE debit_08 END,
                    debit_09 = CASE WHEN bulan = 9 THEN debit_09 - OLD.jumlah ELSE debit_09 END,
                    debit_10 = CASE WHEN bulan = 10 THEN debit_10 - OLD.jumlah ELSE debit_10 END,
                    debit_11 = CASE WHEN bulan = 11 THEN debit_11 - OLD.jumlah ELSE debit_11 END,
                    debit_12 = CASE WHEN bulan = 12 THEN debit_12 - OLD.jumlah ELSE debit_12 END,
                    updated_at = NOW()
                WHERE id = id_debit;

                UPDATE balances SET
                    kredit_01 = CASE WHEN bulan = 1 THEN kredit_01 - OLD.jumlah ELSE kredit_01 END,
                    kredit_02 = CASE WHEN bulan = 2 THEN kredit_02 - OLD.jumlah ELSE kredit_02 END,
                    kredit_03 = CASE WHEN bulan = 3 THEN kredit_03 - OLD.jumlah ELSE kredit_03 END,
                    kredit_04 = CASE WHEN bulan = 4 THEN kredit_04 - OLD.jumlah ELSE kredit_04 END,
                    kredit_05 = CASE WHEN bulan = 5 THEN kredit_05 - OLD.jumlah ELSE kredit_05 END,
                    kredit_06 = CASE WHEN bulan = 6 THEN kredit_06 - OLD.jumlah ELSE kredit_06 END,
                    kredit_07 = CASE WHEN bulan = 7 THEN kredit_07 - OLD.jumlah ELSE kredit_07 END,
                    kredit_08 = CASE WHEN bulan = 8 THEN kredit_08 - OLD.jumlah ELSE kredit_08 END,
                    kredit_09 = CASE WHEN bulan = 9 THEN kredit_09 - OLD.jumlah ELSE kredit_09 END,
                    kredit_10 = CASE WHEN bulan = 10 THEN kredit_10 - OLD.jumlah ELSE kredit_10 END,
                    kredit_11 = CASE WHEN bulan = 11 THEN kredit_11 - OLD.jumlah ELSE kredit_11 END,
                    kredit_12 = CASE WHEN bulan = 12 THEN kredit_12 - OLD.jumlah ELSE kredit_12 END,
                    updated_at = NOW()
                WHERE id = id_kredit;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS after_transaksi_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS after_transaksi_update");
        DB::unprepared("DROP TRIGGER IF EXISTS after_transaksi_delete");
        Schema::dropIfExists('transaksi');
        Schema::dropIfExists('balances');
        Schema::dropIfExists('rekenings');
    }
};
