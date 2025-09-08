<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kabupaten>
 */
class KabupatenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kabupaten' => 'Kabupaten ' . fake()->city(),
            'ibukota_kabupaten' => fake()->city(),
            'jumlah_kecamatan' => fake()->numberBetween(5, 20),
            'deskripsi' => fake()->paragraph(),
        ];
    }
}