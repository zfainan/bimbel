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
        Schema::create('tb_pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->integer('jumlah');
            $table->dateTime('tanggal');
            $table->integer('sisa_bayar');
            $table->string('status');
            $table->foreignId('id_siswa')
                ->constrained(
                    table: 'tb_siswa',
                    column: 'id_siswa',
                    indexName: 'tb_pembayaran_id_siswa_foreign'
                )
                ->onDelete('cascade');
            $table->foreignId('id_program')
                ->constrained(
                    table: 'tb_program',
                    column: 'id_program',
                    indexName: 'tb_pembayaran_id_program_foreign'
                )
                ->onDelete('cascade');
            $table->foreignId('id_cabang')
                ->nullable()
                ->constrained(
                    table: 'tb_cabang',
                    column: 'id_cabang',
                    indexName: 'pembayaran_id_cabang_foreign'
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
        Schema::dropIfExists('tb_pembayaran');
    }
};
