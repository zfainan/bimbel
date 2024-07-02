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
        Schema::create('tb_program', function (Blueprint $table) {
            $table->id('id_program');
            $table->string('nama_program');
            $table->integer('harga');
            $table->string('deskripsi');
            $table->foreignId('id_cabang')
                ->nullable()
                ->constrained(
                    table: 'tb_cabang',
                    column: 'id_cabang',
                    indexName: 'program_id_cabang_foreign'
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
        Schema::dropIfExists('tb_program');
    }
};
