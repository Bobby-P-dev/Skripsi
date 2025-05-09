<?php

namespace Tests\Feature;

use App\Models\Pengguna_Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LaporanControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_laporan(): void
    {
        $user = Pengguna_Model::factory()->create([
            'peran' => 'pelanggan',
        ]);

        $admin = Pengguna_Model::factory()->create([
            'peran' => 'admin',
        ]);

        $this->actingAs($user);

        $data = [
            'pellanggan_id' => $user->pengguna_id,
            'admin_id' => $admin->pengguna_id,
            'judul' => 'Test Laporan',
            'deskripsi' => 'Test Deskripsi',
            'lokasi' => 'Test Lokasi',
            'tingkat_urgensi' => 'Tinggi',
            'status' => 'Diterima',
        ];

        $response = $this->post('/laporan', $data);

        // $response->assertRedirect(route('laporan.index'));
        $this->assertDatabaseHas('laporan', [
            'judul' => 'Laporan Test',
            'admin_id' => $admin->id,
            'pelanggan_id' => $user->id
        ]);
    }

}
