<?php

namespace Database\Factories;

use Faker\Guesser\Name;
use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengguna_Model>
 */
class Pengguna_ModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('qwerty123'),
            'no_telepon' => fake()->unique()->phoneNumber(),
            'alamat' => fake()->address(),
            'peran' => fake()->randomElement(['admin', 'teknisi', 'pelanggan']),
            'foto_profil' => fake()->imageUrl(200, 200, 'people'),
        ];
    }
}
