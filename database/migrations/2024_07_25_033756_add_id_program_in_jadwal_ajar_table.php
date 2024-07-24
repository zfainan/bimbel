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
        Schema::table('jadwal_ajar', function (Blueprint $table) {
            $table->unsignedBigInteger('id_program')->nullable();

            $table->foreign('id_program')
                ->references('id_program')
                ->on('tb_program')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_ajar', function (Blueprint $table) {
            $table->dropColumn('id_program');
        });
    }
};
