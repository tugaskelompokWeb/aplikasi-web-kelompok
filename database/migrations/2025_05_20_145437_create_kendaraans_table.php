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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_plat')->unique();
            $table->string('merek')->nullable();
            $table->string('tipe');
            $table->string('no_rangka');
            $table->string('no_mesin')->nullable();
            $table->string('warna')->nullable();
            $table->year('tahun');
            $table->uuid('pelanggan_id');
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
