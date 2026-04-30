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
        Schema::create('sistem_angsuran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sa', 50);
            $table->string('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('jenis_jasa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jj', 50);
            $table->string('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('jenis_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jt', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_transaksi');
        Schema::dropIfExists('jenis_jasa');
        Schema::dropIfExists('sistem_angsuran');
    }
};
