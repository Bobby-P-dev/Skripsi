<?php

namespace Database\Factories;

use App\Models\Pengguna_Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporan_Model>
 */
class Laporan_ModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pelanggan_id' => Pengguna_Model::factory()->create(['peran' => 'pelanggan']),
            'admin_id' => Pengguna_Model::factory()->create(['peran' => 'admin']),
            'judul' => $this->faker->sentence(4),
            'deskripsi' => $this->faker->paragraph(3),
            'lokasi' => $this->faker->address,
            'foto_url' => $this->faker->imageUrl(640, 480, 'technics'),
            'tingkat_urgensi' => $this->faker->randomElement(['rendah', 'sedang', 'tinggi']),
            'status' => $this->faker->randomElement(['tertunda', 'ditugaskan', 'berlangsung', 'selesai']),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
