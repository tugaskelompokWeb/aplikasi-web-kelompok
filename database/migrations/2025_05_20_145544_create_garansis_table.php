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
            $table->id('id_garansi');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_kendaraan');
            $table->unsignedBigInteger('user_id');
            $table->text('keluhan')->nullable();
            $table->date('tanggal_garansi');
            $table->date('batas_akhir');
            $table->enum('status', ['aktif', 'kadaluarsa', 'batal'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggan')->onDelete('cascade');
            $table->foreign('id_kendaraan')->references('id_kendaraan')->on('kendaraan')->onDelete('cascade');
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
