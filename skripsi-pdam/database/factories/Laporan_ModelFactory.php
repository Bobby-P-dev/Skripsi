<?php

namespace Database\Factories;

use App\Models\Pengguna_Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

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
    protected $model = Laporan_Model::class;
    public function definition(): array
    {
        return [
            'laporan_uuid' => (string) Str::uuid(),
            'pelanggan_id' => Pengguna_Model::factory()->create(['peran' => 'pelanggan'])->pengguna_id,
            'admin_id' => Pengguna_Model::factory()->create(['peran' => 'admin'])->pengguna_id,
            'judul' => $this->faker->sentence(4),
            'deskripsi' => $this->faker->paragraph(3),
            'lokasi' => $this->faker->address,
            'latitude' => $this->faker->latitude(),   // <-- TAMBAHKAN INI
            'longitude' => $this->faker->longitude(), // <-- TAMBAHKAN INI (jika ada kolom longitude)
            'foto_url' => $this->faker->imageUrl(640, 480, 'technics'),
            'tingkat_urgensi' => $this->faker->randomElement(['rendah', 'sedang', 'tinggi']),
            'status' => $this->faker->randomElement(['tertunda', 'dilaporkan']),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
