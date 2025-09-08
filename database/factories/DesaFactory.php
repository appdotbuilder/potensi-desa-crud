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
        $kecamatan = Kecamatan::inRandomOrder()->first() ?? Kecamatan::factory()->create();
        
        return [
            'nama_desa' => 'Desa ' . fake()->city(),
            'kecamatan_id' => $kecamatan->id,
            'kabupaten_id' => $kecamatan->kabupaten_id,
            'alamat' => fake()->address(),
            'kode_pos' => fake()->postcode(),
            'kepala_desa' => fake()->name(),
            'luas_wilayah_total' => fake()->randomFloat(2, 100, 5000),
        ];
    }
}