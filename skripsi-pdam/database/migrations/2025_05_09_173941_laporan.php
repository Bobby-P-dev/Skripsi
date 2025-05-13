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
        Schema::create('laporan', function (Blueprint $table) {
            $table->uuid('laporan_uuid')->primary();
            $table->foreignId('pelanggan_id')->constrained(table: 'pengguna',indexName: 'fk_laporan_pelanggan')
                  ->references('pengguna_id')
                  ->on('pengguna')
                  ->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained(table: 'pengguna',indexName: 'fk_laporan_admin')
                  ->references('pengguna_id')
                  ->on('pengguna')
                  ->onDelete('set null');
            $table->string('judul');
            $table->text('deskripsi');
            $table->text('lokasi');
            $table->string('foto_url')->nullable();
            $table->enum('tingkat_urgensi', ['rendah', 'sedang', 'tinggi'])->index();
            $table->enum('status', ['tertunda', 'ditugaskan', 'berlangsung', 'selesai'])
                  ->default('tertunda')
                  ->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
