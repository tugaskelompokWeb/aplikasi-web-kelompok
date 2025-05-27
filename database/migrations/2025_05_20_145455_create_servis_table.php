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
        Schema::create('servis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tgl_datang');
            $table->date('tgl_keluar')->nullable();
            $table->decimal('total_biaya', 10, 2)->nullable();
            $table->text('keluhan_awal')->nullable();
            $table->enum('status_servis', ['proses', 'selesai', 'dibatalkan'])->default('proses');
            $table->uuid('kendaraan_id');
            $table->uuid('mekanik_id');
            $table->timestamps();

            $table->foreign('kendaraan_id')->references('id')->on('kendaraan')->onDelete('cascade');
            $table->foreign('mekanik_id')->references('id')->on('mekanik')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servis');
    }
};
