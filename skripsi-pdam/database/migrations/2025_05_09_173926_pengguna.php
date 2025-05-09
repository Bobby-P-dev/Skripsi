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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('pengguna_id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telepon')->index();
            $table->string('alamat');
            $table->enum('peran', ['admin', 'teknisi', 'pelanggan'])->default('pelanggan')->index();
            $table->string('foto_profil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
