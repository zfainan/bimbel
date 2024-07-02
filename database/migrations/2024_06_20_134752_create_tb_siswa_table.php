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
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('nama', 30);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('alamat', 50);
            $table->string('no_telp', 15);
            $table->string('nama_ortu', 30);
            $table->string('no_telp_ortu', 15);
            $table->string('pekerjaan_ortu', 15);
            $table->string('asal_sekolah', 30);
            $table->string('kelas', 10);
            $table->string('status', 10);
            $table->foreignId('id_program')
                ->nullable()
                ->constrained(
                    table: 'tb_program',
                    column: 'id_program',
                    indexName: 'siswa_id_program_foreign'
                )
                ->onDelete('cascade');
            $table->foreignId('id_cabang')
                ->nullable()
                ->constrained(
                    table: 'tb_cabang',
                    column: 'id_cabang',
                    indexName: 'siswa_id_cabang_foreign'
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
        Schema::dropIfExists('tb_siswa');
    }
};
