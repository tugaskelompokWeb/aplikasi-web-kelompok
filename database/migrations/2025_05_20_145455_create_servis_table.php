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
            $table->id('id_servis');
            $table->date('tgl_datang');
            $table->date('tgl_keluar')->nullable();
            $table->decimal('total_biaya', 10, 2)->nullable();
            $table->unsignedBigInteger('id_kendaraan');
            $table->unsignedBigInteger('id_mekanik');
            $table->timestamps();

            $table->foreign('id_kendaraan')->references('id_kendaraan')->on('kendaraans')->onDelete('cascade');
            $table->foreign('id_mekanik')->references('id_mekanik')->on('mekaniks')->onDelete('cascade');
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
