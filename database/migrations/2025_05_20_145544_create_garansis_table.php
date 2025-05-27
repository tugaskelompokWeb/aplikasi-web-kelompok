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
        Schema::create('garansi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pelanggan_id');
            $table->uuid('kendaraan_id');
            $table->unsignedBigInteger('user_id');
            $table->text('keluhan')->nullable();
            $table->date('tanggal_garansi');
            $table->date('batas_akhir');
            $table->enum('status', ['aktif', 'kadaluarsa', 'batal'])->default('aktif');
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraan')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garansis');
    }
};
