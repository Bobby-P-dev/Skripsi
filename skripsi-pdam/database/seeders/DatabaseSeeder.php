<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use App\Models\Penugasan_Model;
use Database\Factories\Pengguna_ModelFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Penugasan_Model::factory()->count(1)->create();
        // $pelanggan = Pengguna_Model::where('peran', 'penlanggan')->first();
        // $admin = Pengguna_Model::where('peran', 'admin')->first();
        // Pengguna_Model::factory(10)->create();
        // Laporan_Model::factory()->create([
        //     'pelanggan_id' => 7,
        //     'admin_id' => 3,
        //     'judul' => 'pelaporan kerusakan',
        //     'deskripsi' => 'tidak menyala',
        //     'lokasi' => 'bekasi',
        //     'tingkat_urgensi' => 'tinggi',
        //     'foto_url' => 'https://ashdjab',

        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
