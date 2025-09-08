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
        $totalPenduduk = fake()->numberBetween(500, 3000);
        $lakiLaki = random_int(200, intval($totalPenduduk * 0.6));
        $perempuan = $totalPenduduk - $lakiLaki;
        
        $usia014 = random_int(100, intval($totalPenduduk * 0.3));
        $usia1564 = random_int(200, intval($totalPenduduk * 0.6));
        $usia65plus = $totalPenduduk - $usia014 - $usia1564;
        
        return [
            'desa_id' => Desa::factory(),
            'total_penduduk' => $totalPenduduk,
            'laki_laki' => $lakiLaki,
            'perempuan' => $perempuan,
            'usia_0_14' => $usia014,
            'usia_15_64' => $usia1564,
            'usia_65_plus' => $usia65plus,
            'agama_mayoritas' => fake()->randomElement(['islam', 'kristen', 'katolik', 'hindu', 'buddha']),
            'islam' => random_int(300, intval($totalPenduduk * 0.8)),
            'kristen' => random_int(50, 200),
            'katolik' => random_int(20, 100),
            'hindu' => random_int(10, 50),
            'buddha' => random_int(5, 30),
            'konghucu' => random_int(0, 10),
            'tidak_sekolah' => random_int(50, 200),
            'sd' => random_int(200, 800),
            'smp' => random_int(150, 500),
            'sma' => random_int(100, 300),
            'diploma' => random_int(20, 100),
            'sarjana' => random_int(10, 80),
            'petani' => random_int(200, 800),
            'pedagang' => random_int(50, 200),
            'pns' => random_int(10, 100),
            'swasta' => random_int(100, 300),
            'tidak_bekerja' => random_int(100, 400),
            'tahun_data' => fake()->numberBetween(2020, 2024),
        ];
    }
}