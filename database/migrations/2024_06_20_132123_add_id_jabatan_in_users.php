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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('id_jabatan')
                ->constrained(
                    table: 'tb_jabatan',
                    column: 'id_jabatan',
                    indexName: 'users_id_jabatan_foreign'
                )
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_id_jabatan_foreign');
            $table->dropColumn('id_jabatan');
        });
    }
};
