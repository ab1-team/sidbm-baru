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
        Schema::create('app_updates', function (Blueprint $table) {
            $table->id();
            $table->string('latest_version', 225);
            $table->integer('version_code');
            $table->string('apk_name', 225);
            $table->string('apk_url', 225);
            $table->text('changelog');
            $table->boolean('force_update');
            $table->integer('min_supported_version');
            $table->timestamps();
        });

        Schema::create('api_endpoints', function (Blueprint $table) {
            $table->id();
            $table->string('whatsapp_api', 225);
            $table->string('update_api', 225);
            $table->timestamps();
        });

        Schema::create('mobile_devices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lokasi')->nullable();
            $table->string('unique_id', 50);
            $table->string('aktivasi', 255)->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });

        Schema::create('data_pemanfaat', function (Blueprint $table) {
            $table->id();
            $table->integer('lokasi');
            $table->string('nik', 50);
            $table->integer('id_pinkel')->nullable();
            $table->integer('idpa');
            $table->string('status', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pemanfaat');
        Schema::dropIfExists('mobile_devices');
        Schema::dropIfExists('api_endpoints');
        Schema::dropIfExists('app_updates');
    }
};
