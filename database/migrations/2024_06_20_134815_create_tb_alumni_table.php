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
        Schema::create('tb_alumni', function (Blueprint $table) {
            $table->id('id_alumni');
            $table->double('nilai_ujian');
            $table->string('pendidikan_lanjutan', 20);
            $table->string('tahun_angkatan', 10);
            $table->foreignId('id_siswa')
                ->constrained(
                    table: 'tb_siswa',
                    column: 'id_siswa',
                    indexName: 'tb_alumni_id_siswa_foreign'
                )
                ->onDelete('cascade');
            $table->foreignId('id_cabang')
                ->nullable()
                ->constrained(
                    table: 'tb_cabang',
                    column: 'id_cabang',
                    indexName: 'alumni_id_cabang_foreign'
                )
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_alumni');
    }
};
