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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('no_transaksi')->unique()->after('id');
            $table->date('tanggal')->default(now())->after('user_id');
            $table->decimal('pajak', 10, 2)->default(0);
            $table->decimal('diskon', 10, 2)->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn(['no_transaksi', 'pajak', 'diskon']);
        });
    }
};
