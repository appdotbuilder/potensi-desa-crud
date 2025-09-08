<?php

namespace Database\Factories;

use App\Models\Kabupaten;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kecamatan>
 */
class KecamatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kecamatan' => 'Kecamatan ' . fake()->city(),
            'kabupaten_id' => Kabupaten::factory(),
            'ibukota_kecamatan' => fake()->city(),
            'jumlah_desa' => fake()->numberBetween(5, 15),
            'deskripsi' => fake()->paragraph(),
        ];
    }
}