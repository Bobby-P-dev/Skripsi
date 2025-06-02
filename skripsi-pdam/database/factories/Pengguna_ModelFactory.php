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
    protected $model = Pengguna_Model::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(), // Penting: unique()
            'password' => Hash::make('qwerty123'),
            'no_telepon' => $this->faker->unique()->phoneNumber(),
            'alamat' => $this->faker->address(),
            'peran' => $this->faker->randomElement(['admin', 'teknisi', 'pelanggan']),
            'foto_profil' => $this->faker->imageUrl(200, 200, 'people'),
        ];
    }

    // Opsional: States untuk peran agar lebih mudah
    public function admin()
    {
        return $this->state(fn(array $attributes) => ['peran' => 'admin']);
    }

    public function teknisi()
    {
        return $this->state(fn(array $attributes) => ['peran' => 'teknisi']);
    }

    public function pelanggan()
    {
        return $this->state(fn(array $attributes) => ['peran' => 'pelanggan']);
    }
}
