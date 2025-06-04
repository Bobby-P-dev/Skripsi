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
            'laporan_uuid' => \App\Models\Laporan_Model::inRandomOrder()->first()->laporan_uuid,
            'teknisi_id' => Pengguna_Model::where('peran', 'teknisi')->inRandomOrder()->first()->pengguna_id,
            'admin_id' => Pengguna_Model::where('peran', 'admin')->inRandomOrder()->first()->pengguna_id,
            'tenggat_waktu' => $this->faker->dateTimeBetween('now', '+1 month'),
            'catatan' => $this->faker->paragraph(2),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
