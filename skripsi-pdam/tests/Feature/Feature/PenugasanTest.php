<?php

namespace Tests\Feature\Feature;

use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use Database\Factories\Laporan_ModelFactory;
use Database\Factories\Pengguna_ModelFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PenugasanTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase, WithFaker;
    public function test_penugasan(): void
    {

        $admin = Pengguna_Model::factory()->create([
            'peran' => 'admin',
            'nama' => 'Admin Otomatis',
            'email' => 'admin_auto@example.com', // Pastikan email unik
        ]);
        // Ambil ID admin yang di-generate
        $adminIdOtomatis = $admin->pengguna_id; // Asumsi primary key adalah pengguna_id

        // Membuat user teknisi dengan peran spesifik
        // ID (pengguna_id) akan di-generate otomatis
        $teknisi = Pengguna_Model::factory()->create([
            'peran' => 'teknisi',
            'nama' => 'Teknisi Otomatis',
            'email' => 'teknisi_auto@example.com', // Pastikan email unik
        ]);
        // Ambil ID teknisi yang di-generate
        $teknisiIdOtomatis = $teknisi->pengguna_id;

        // Membuat data laporan.
        // laporan_uuid dan field lain akan diisi oleh Laporan_ModelFactory.
        // Kita hanya perlu memastikan status awalnya sesuai untuk skenario penugasan.
        $laporan = Laporan_Model::factory()->create([
            'status' => 'pending', // Status awal spesifik jika diperlukan untuk test,
            // atau biarkan factory yang menentukan jika sudah sesuai.
        ]);
        // Ambil UUID laporan yang di-generate
        $laporanUuidOtomatis = $laporan->laporan_uuid;

        // Data yang akan dikirim (payload)
        $penugasanData = [
            'laporan_uuid' => $laporanUuidOtomatis,
            'teknisi_id' => $teknisiIdOtomatis,
            'tenggat_waktu' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'catatan' => 'Catatan untuk penugasan test dengan ID otomatis.',
        ];

        // 2. Aksi
        $response = $this->actingAs($admin) // Login sebagai $admin
            ->post(route('penugasan.store'), $penugasanData);

        // 3. Asersi
        $response->assertRedirect(route('penugasan.index'));
        $response->assertSessionHas('success', 'Penugasan berhasil dibuat.');

        $this->assertDatabaseHas('penugasan', [
            'laporan_uuid' => $laporanUuidOtomatis,
            'teknisi_id' => $teknisiIdOtomatis,
            'admin_id' => $adminIdOtomatis,
            'catatan' => $penugasanData['catatan'],
        ]);

        $this->assertDatabaseHas('laporan', [
            'laporan_uuid' => $laporanUuidOtomatis,
            'status' => 'ditugaskan', // Status akhir setelah penugasan
        ]);
    }
}
