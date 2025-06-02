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

        $admin = Pengguna_Model::factory()->admin()->create([
            // Menggunakan state admin() dari factory jika ada,
            // atau 'peran' => 'admin' jika tidak ada state
            'nama' => 'Super Admin Test',
            // Email akan di-generate unik oleh Pengguna_ModelFactory
        ]);
        $adminIdOtomatis = $admin->pengguna_id; // Ambil ID (pengguna_id)

        // Membuat user teknisi
        $teknisi = Pengguna_Model::factory()->teknisi()->create([
            // Menggunakan state teknisi() dari factory jika ada,
            // atau 'peran' => 'teknisi' jika tidak ada state
            'nama' => 'Teknisi Handal Test',
            // Email akan di-generate unik oleh Pengguna_ModelFactory
        ]);
        $teknisiIdOtomatis = $teknisi->pengguna_id; // Ambil ID (pengguna_id)

        // Membuat data laporan.
        // laporan_uuid dan field lain akan diisi oleh Laporan_ModelFactory.
        $laporan = Laporan_Model::factory()->create([
            'status' => 'tertunda', // Pastikan status awal sesuai untuk skenario
        ]);
        $laporanUuidOtomatis = $laporan->laporan_uuid; // Ambil UUID

        // Data yang akan dikirim untuk membuat penugasan
        $penugasanData = [
            'laporan_uuid' => $laporanUuidOtomatis,
            'teknisi_id' => $teknisiIdOtomatis,
            'tenggat_waktu' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'catatan' => 'Catatan untuk penugasan test dengan ID otomatis.',
        ];

        // 2. Aksi
        $response = $this->actingAs($admin, 'web') // Login sebagai $admin, tentukan guard jika perlu
            ->post(route('penugasan.store'), $penugasanData);

        // 3. Asersi (Verifikasi)
        $response->assertRedirect(route('penugasan.index'));
        $response->assertSessionHas('success', 'Penugasan berhasil dibuat.');

        $this->assertDatabaseHas('penugasan', [ // Sesuaikan nama tabel jika berbeda ('penugasans'?)
            'laporan_uuid' => $laporanUuidOtomatis,
            'teknisi_id' => $teknisiIdOtomatis,
            'admin_id' => $adminIdOtomatis,
            'catatan' => $penugasanData['catatan'],
        ]);

        $this->assertDatabaseHas('laporan', [ // Sesuaikan nama tabel jika berbeda ('laporans'?)
            'laporan_uuid' => $laporanUuidOtomatis,
            'status' => 'ditugaskan', // Status akhir setelah penugasan
        ]);
    }
}
