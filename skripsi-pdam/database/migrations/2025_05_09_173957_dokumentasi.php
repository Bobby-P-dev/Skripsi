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
        Schema::create('dokumentasi', function (Blueprint $table) {
            $table->id('dokumentasi_id');
            $table->foreignUuid('laporan_uuid')->constrained('laporan', indexName: 'fk_dokumentasi_laporan')->references('laporan_uuid')->onDelete('cascade');
            $table->foreignId('teknisi_id')->constrained('pengguna', indexName: 'fx_dokumentasi_teknisi')->references('pengguna_id')->onDelete('cascade');
            $table->string('foto_url');
            $table->text('keterangan');
            $table->text('tindakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi');
    }
};
