<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FasilitasUmum>
 */
class FasilitasUmumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenis = fake()->randomElement([
            'balai_desa', 'masjid', 'gereja', 'pos_ronda', 'pasar', 
            'lapangan_olahraga', 'makam', 'jembatan'
        ]);

        $namaFasilitas = match($jenis) {
            'balai_desa' => 'Balai Desa ' . fake()->word(),
            'masjid' => 'Masjid ' . fake()->word(),
            'gereja' => 'Gereja ' . fake()->word(),
            'pos_ronda' => 'Pos Ronda RT ' . fake()->numberBetween(1, 10),
            'pasar' => 'Pasar Desa',
            'lapangan_olahraga' => 'Lapangan ' . fake()->randomElement(['Sepak Bola', 'Voli', 'Basket']),
            'makam' => 'Makam Umum',
            'jembatan' => 'Jembatan ' . fake()->word(),
            default => 'Fasilitas ' . fake()->word(),
        };

        return [
            'desa_id' => Desa::factory(),
            'jenis_fasilitas' => $jenis,
            'nama_fasilitas' => $namaFasilitas,
            'jumlah' => fake()->numberBetween(1, 5),
            'kondisi' => fake()->randomElement(['baik', 'rusak_ringan', 'rusak_berat']),
            'lokasi' => fake()->address(),
            'tahun_dibangun' => fake()->numberBetween(1990, 2023),
            'keterangan' => fake()->sentence(),
        ];
    }
}