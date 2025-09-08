<?php

namespace Database\Factories;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Demografi>
 */
class DemografiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lakiLaki = fake()->numberBetween(100, 500);
        $perempuan = fake()->numberBetween(100, 500);
        $total = $lakiLaki + $perempuan;
        
        return [
            'desa_id' => Desa::factory(),
            'total_penduduk' => $total,
            'laki_laki' => $lakiLaki,
            'perempuan' => $perempuan,
            'usia_0_2' => fake()->numberBetween(10, 50),
            'usia_0_5' => fake()->numberBetween(20, 80),
            'usia_17_plus' => fake()->numberBetween(200, 700),
            'agama' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'pendidikan_terakhir' => fake()->randomElement(['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Pascasarjana']),
            'pekerjaan' => fake()->randomElement(['Petani', 'Pedagang', 'PNS', 'Swasta', 'Nelayan', 'Buruh', 'Lainnya']),
        ];
    }
}