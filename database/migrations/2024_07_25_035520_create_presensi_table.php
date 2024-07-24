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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pertemuan')
                ->nullable()
                ->constrained(
                    table: 'pertemuan',
                    indexName: 'presensi_id_pertemuan_foreign'
                )
                ->onDelete('cascade');
            $table->foreignId('id_cabang')
                ->nullable()
                ->constrained(
                    table: 'tb_cabang',
                    column: 'id_cabang',
                    indexName: 'presensi_id_cabang_foreign'
                )
                ->onDelete('cascade');
            $table->foreignId('id_siswa')
                ->nullable()
                ->constrained(
                    table: 'tb_siswa',
                    column: 'id_siswa',
                    indexName: 'presensi_id_siswa_foreign'
                )
                ->onDelete('cascade');
            $table->timestamp('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
