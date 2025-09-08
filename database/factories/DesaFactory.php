<?php

namespace Database\Factories;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Desa>
 */
class DesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kabupaten_id' => Kabupaten::factory(),
            'kecamatan_id' => Kecamatan::factory(),
            'nama_desa' => 'Desa ' . fake()->lastName(),
            'alamat' => fake()->address(),
            'kode_pos' => fake()->postcode(),
            'telepon' => fake()->phoneNumber(),
            'nama_kepala_desa' => fake()->name(),
            'luas_wilayah' => fake()->randomFloat(2, 50, 1000),
            'jumlah_penduduk' => fake()->numberBetween(500, 5000),
        ];
    }
}