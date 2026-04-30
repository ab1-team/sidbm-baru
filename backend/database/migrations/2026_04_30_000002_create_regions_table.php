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
        Schema::create('kabupaten', function (Blueprint $table) {
            $table->id();
            $table->string('kd_prov', 50)->nullable();
            $table->string('kd_kab', 50)->nullable();
            $table->string('nama_kab', 60)->default('0');
            $table->date('tgl_pakai')->nullable();
            $table->string('nama_lembaga', 50)->default('0');
            $table->string('alamat_kab', 100)->default('0');
            $table->string('telpon_kab', 20)->default('0');
            $table->string('email_kab', 50)->default('0');
            $table->string('web_kab', 100)->default('0');
            $table->string('web_kab_alternatif', 100)->default('0');
            $table->string('online', 1)->default('0');
            $table->string('lo', 50)->nullable();
            $table->string('ip', 30)->default('0');
            $table->text('tanda_tangan')->nullable();
            $table->integer('nilai')->default(0);
            $table->string('uname', 20)->default('0');
            $table->string('pass', 50)->default('0');
            $table->timestamps();
        });

        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->string('kd_kab', 50)->nullable();
            $table->string('kd_kec', 50)->nullable();
            $table->string('nama_kec', 255)->default('0');
            $table->string('nama_lembaga_sort', 100)->default('0');
            $table->string('nama_lembaga_long', 200)->default('0');
            $table->string('alamat_kec', 255)->default('0');
            $table->string('telpon_kec', 20)->default('0');
            $table->string('email_kec', 255)->default('0');
            $table->string('web_kec', 255)->default('0');
            $table->string('logo', 225)->default('0');
            $table->timestamps();
        });

        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->string('kd_kec', 16)->default('0');
            $table->text('nama_kec')->nullable();
            $table->string('kd_desa', 16)->default('0');
            $table->string('nama_desa', 50)->default('0');
            $table->string('alamat_desa', 100)->default('0');
            $table->string('telp_desa', 15)->default('0');
            $table->integer('sebutan')->default(0);
            $table->string('kode_desa', 16)->default('0');
            $table->string('kades', 50)->default('0');
            $table->string('pangkat', 50)->default('0');
            $table->string('nip', 50)->default('0');
            $table->string('no_kades', 20)->default('0');
            $table->string('sekdes', 50)->default('0');
            $table->string('no_sekdes', 15)->default('0');
            $table->string('ked', 50)->default('0');
            $table->string('no_ked', 15)->default('0');
            $table->text('deskripsi_desa')->nullable();
            $table->string('online', 1)->default('0');
            $table->dateTime('lo')->nullable();
            $table->string('kunjungan', 10)->default('0');
            $table->string('nilai', 1)->default('0');
            $table->string('jadwal_angsuran_desa', 2)->default('0');
            $table->string('uname', 20)->default('0');
            $table->string('pass', 20)->default('0');
            $table->string('laba_th_lalu', 50)->default('0');
            $table->string('laba_saat_ini', 50)->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa');
        Schema::dropIfExists('kecamatan');
        Schema::dropIfExists('kabupaten');
    }
};
