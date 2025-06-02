<?php

namespace Database\Factories;

use App\Models\Pengguna_Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penugasan_Model>
 */
class Penugasan_ModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'laporan_uuid' => $this->faker->uuid,
            'teknisi_id' => Pengguna_Model::factory()->create(['peran' => 'teknisi']),
            'admin_id' => Pengguna_Model::factory()->create(['peran' => 'admin']),
            'tenggat_waktu' => $this->faker->dateTimeBetween('now', '+1 month'),
            'catatan' => $this->faker->paragraph(2),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
