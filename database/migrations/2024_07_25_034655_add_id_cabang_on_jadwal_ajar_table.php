<?php

declare(strict_types=1);

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
        Schema::table('jadwal_ajar', function (Blueprint $table) {
            $table->unsignedBigInteger('id_cabang')->nullable();

            $table->foreign('id_cabang')
                ->references('id_cabang')
                ->on('tb_cabang')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_ajar', function (Blueprint $table) {
            $table->dropColumn('id_cabang');
        });
    }
};
