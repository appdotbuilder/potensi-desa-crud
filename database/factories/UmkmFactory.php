<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Umkm>
 */
class UmkmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'desa_id' => Desa::factory(),
            'nama_usaha' => fake()->company(),
            'jenis_usaha' => fake()->randomElement(['Perdagangan', 'Jasa', 'Manufaktur', 'Kuliner']),
            'jumlah_pekerja' => fake()->numberBetween(1, 50),
            'omset_tahunan' => fake()->randomFloat(2, 10000000, 500000000),
            'alamat' => fake()->address(),
            'pemilik' => fake()->name(),
            'kontak' => fake()->phoneNumber(),
        ];
    }
}