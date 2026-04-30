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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->integer('sort');
            $table->string('title', 225);
            $table->string('akses', 255)->nullable();
            $table->string('ikon', 225);
            $table->enum('type', ['text', 'material', ''])->default('');
            $table->string('link', 225);
            $table->string('aktif', 5)->default('Y');
            $table->timestamps();
        });

        Schema::create('menu_tombols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->string('text', 225);
            $table->string('akses', 225)->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_tombols');
        Schema::dropIfExists('menus');
    }
};
