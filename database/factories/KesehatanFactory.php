<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kesehatan>
 */
class KesehatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisFasilitas = fake()->randomElement(['puskesmas', 'pustu', 'posyandu', 'polindes', 'bidan_desa', 'dokter_praktek']);
        
        $namaFasilitas = match($jenisFasilitas) {
            'puskesmas' => 'Puskesmas ' . fake()->word(),
            'pustu' => 'Puskesmas Pembantu ' . fake()->word(),
            'posyandu' => 'Posyandu ' . fake()->word(),
            'polindes' => 'Polindes ' . fake()->word(),
            'bidan_desa' => 'Bidan Desa ' . fake()->firstName(),
            'dokter_praktek' => 'Praktek Dr. ' . fake()->name(),
            default => 'Fasilitas Kesehatan ' . fake()->word(),
        };

        return [
            'desa_id' => Desa::factory(),
            'jenis_fasilitas' => $jenisFasilitas,
            'nama_fasilitas' => $namaFasilitas,
            'jumlah_tenaga_medis' => fake()->numberBetween(1, 10),
            'peralatan' => fake()->randomElement([
                'Tensimeter, Timbangan, Termometer',
                'Peralatan P3K, Kursi Roda',
                'Alat Ukur Tinggi Badan, Timbangan Bayi',
                'Kit Persalinan, Peralatan Medis Dasar'
            ]),
            'kondisi' => fake()->randomElement(['baik', 'rusak_ringan', 'rusak_berat']),
            'alamat' => fake()->address(),
            'jam_operasional' => fake()->randomElement([
                '08:00 - 16:00',
                '07:00 - 15:00', 
                '24 Jam',
                'Senin-Jumat 08:00-16:00'
            ]),
        ];
    }
}