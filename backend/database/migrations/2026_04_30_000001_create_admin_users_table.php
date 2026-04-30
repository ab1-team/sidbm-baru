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
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 225);
            $table->string('gmail', 225)->unique();
            $table->string('password', 225);
            $table->string('akses', 50);
            $table->string('lokasi', 50);
            $table->string('kabupaten', 50);
            $table->string('provinsi', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
    }
};
