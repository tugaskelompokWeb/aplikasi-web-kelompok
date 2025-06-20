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
        Schema::create('detail_servis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('servis_id');
            $table->uuid('jasa_id');
            $table->timestamps();

            $table->foreign('servis_id')->references('id')->on('servis')->onDelete('cascade');
            $table->foreign('jasa_id')->references('id')->on('jasa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_servis');
    }
};
