<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pendidikan>
 */
class PendidikanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisSekolah = fake()->randomElement(['paud', 'tk', 'sd', 'smp', 'sma', 'smk']);
        
        $namaSekolah = match($jenisSekolah) {
            'paud' => 'PAUD ' . fake()->word(),
            'tk' => 'TK ' . fake()->word(),
            'sd' => 'SDN ' . fake()->numberBetween(1, 5),
            'smp' => 'SMPN ' . fake()->numberBetween(1, 3),
            'sma' => 'SMAN ' . fake()->numberBetween(1, 2),
            'smk' => 'SMKN ' . fake()->numberBetween(1, 2),
            default => fake()->word() . ' School',
        };

        $jumlahSiswa = match($jenisSekolah) {
            'paud', 'tk' => fake()->numberBetween(20, 80),
            'sd' => fake()->numberBetween(100, 300),
            'smp' => fake()->numberBetween(80, 200),
            'sma', 'smk' => fake()->numberBetween(100, 250),
            default => fake()->numberBetween(50, 200),
        };

        return [
            'desa_id' => Desa::factory(),
            'jenis_sekolah' => $jenisSekolah,
            'nama_sekolah' => $namaSekolah,
            'jumlah_siswa' => $jumlahSiswa,
            'jumlah_guru' => fake()->numberBetween(5, intval($jumlahSiswa / 20)),
            'jumlah_ruang_kelas' => fake()->numberBetween(3, intval($jumlahSiswa / 30)),
            'kondisi_bangunan' => fake()->randomElement(['baik', 'rusak_ringan', 'rusak_berat']),
            'fasilitas' => fake()->randomElement([
                'Perpustakaan, Laboratorium Komputer',
                'Perpustakaan, Lapangan Olahraga',
                'Kantin, Mushola',
                'Laboratorium IPA, Perpustakaan'
            ]),
            'alamat' => fake()->address(),
            'tahun_berdiri' => fake()->numberBetween(1980, 2020),
        ];
    }
}