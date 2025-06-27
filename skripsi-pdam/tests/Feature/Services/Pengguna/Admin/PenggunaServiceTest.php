<?php

namespace Tests\Feature\Services\Pengguna\Admin;

use App\Models\Pengguna_Model;
use App\Services\Pengguna\Admin\PenggunaAdmin;
use App\Services\Pengguna\Admin\PenggunaAdminImpl;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PhpParser\Node\Expr\New_;
use Tests\TestCase;

class PenggunaServiceTest extends TestCase
{
    use RefreshDatabase;

    protected PenggunaAdmin $services;

    protected function setUp(): void
    {
        parent::setUp(); // Wajib untuk menjalankan setup dari parent class

        // Minta Laravel untuk membuatkan instance dari service kita melalui Service Container.
        // Ini akan secara otomatis memberikan PenggunaAdminImpl jika sudah di-binding.
        $this->services = $this->app->make(PenggunaAdmin::class);
    }

    public function test_pengguna_update(): void
    {
        Pengguna_Model::factory()->create([
            'pengguna_id' => 102,
            'nama' => 'Test User2',
            'email' => 'tets2@gmail.com',
            'password' => 'password',
            'no_telepon' => '1234567891',
            'alamat' => 'Test Address',
            'peran' => 'admin',
            'foto_profil' => 'test.jpg',
        ]);

        $userUPdate = [
            'pengguna_id' => 102,
            'nama' => 'Ganti Nama2',
            'email' => 'ganti2@gmail.com',
            'alamat' => 'Beaksi',
            'peran' => 'admin',
            'foto_profil' => 'test1.jpg',
        ];


        $updateDataPengguna = $this->services->EditStore($userUPdate, 102);

        $this->assertNotNull($updateDataPengguna);
        $this->assertDatabaseHas('pengguna', [
            'pengguna_id' => 102,
            'nama' => 'Ganti Nama2',
            'email' => 'ganti2@gmail.com',
            'password' => 'password',
            'no_telepon' => '1234567891',
            'alamat' => 'Beaksi',
            'peran' => 'admin',
            'foto_profil' => 'test1.jpg',
        ]);

        $this->assertInstanceOf(Pengguna_Model::class, $updateDataPengguna);
        $this->assertEquals('Ganti Nama2', $updateDataPengguna->nama);
    }




    public function test_pengguna_delete()
    {
        $user = Pengguna_Model::factory()->create();

        // ACT
        // Gunakan service yang sudah disiapkan di setUp() melalui $this->services
        // Semua kode harus berada DI DALAM method test
        $deletePengguna = $this->services->DeletePengguna($user->pengguna_id);

        // ASSERT
        $this->assertTrue($deletePengguna, "Metode delete seharusnya mengembalikan true.");
        $this->assertDatabaseMissing('pengguna', [
            'pengguna_id' => $user->pengguna_id,
        ]);
    }
}
