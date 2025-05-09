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
        Schema::create('penugasan', function (Blueprint $table) {
            $table->id('penugasan_id');
            $table->foreignUuid('laporan_uuid')->constrained('laporan', indexName: 'fk_penugasan_laporan')->references('laporan_uuid')->onDelete('cascade');
            $table->foreignId('teknisi_id')->constrained('pengguna', indexName: 'fk_penugasan_teknisi')->references('pengguna_id')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('pengguna', indexName: 'fk_penugasan_admin')->references('pengguna_id')->onDelete('set null');
            $table->timestamp('tenggat_waktu')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penugasan');
    }
};
